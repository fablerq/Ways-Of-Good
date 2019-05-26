<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VkAuthService;
use App\Services\VkUserService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;


class VkAuthController extends Controller
{
    /**
     * Redirect the user to the Vk authentication page.
     *
     * @return RedirectResponse
     */
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    /**
     * Obtain the user information from Vk.
     *
     * @param VkAuthService $vkAuthService
     * @param VkUserService $vkUserService
     * @return RedirectResponse
     */
    public function handleProviderCallback(
        VkAuthService $vkAuthService,
        VkUserService $vkUserService
    ): RedirectResponse
    {
        try {
            $user = Socialite::driver('vkontakte')->user();
        } catch (InvalidStateException $e) {  // If returned data is invalid
            return redirect()->home();
        } catch (ClientException $e) { // If access denied
            return redirect()->home();
        }

        $authUser = $vkAuthService->authFromVK($user->user);
        $vkUserService->setBigAvatarUri($authUser, $user->accessTokenResponseBody['access_token']);

        return redirect()->home();
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('welcome');
    }
}

