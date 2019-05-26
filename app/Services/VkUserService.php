<?php

namespace App\VkUserService;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;


class VkUserService
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * VkUserService constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Update user avatar from VK.
     *
     * @param Authenticatable $user
     * @param string $userToken
     * @return bool
     */
    public function setBigAvatarUri(Authenticatable $user, string $userToken): bool
    {
        if (is_null($user->avatar_url)) {
            return $user->update([
                'avatar_url' => $this->getBigAvatarUri($userToken)
            ]);
        }

        return true;
    }

    /**
     * Get photo_max_orig value from response data object.
     *
     * @param string $userToken
     * @return string | null
     */
    public function getBigAvatarUri(string $userToken): ?string
    {
        return $this->getUserData($userToken, ['photo_max_orig'])
            ->photo_max_orig;
    }

    /**
     * Call API method users.get and return response data as object.
     *
     * @param string $userToken
     * @param array $fields
     * @return object | null
     */
    public function getUserData(string $userToken, array $fields = []): ?object
    {
        try {
            $response = $this->client->request('GET', 'users.get', [
                'query' => [
                    'access_token' => $userToken,
                    'v' => '5.92',
                    'fields' => implode($fields)
                ]
            ]);
        } catch (GuzzleException $e) {
            Log::error("Cannot load user (token: {$userToken}) avatar");

            return null;
        }

        return json_decode(
            $response->getBody()->getContents()
        )->response[0];
    }
}
