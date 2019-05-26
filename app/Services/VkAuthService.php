<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class VkAuthService{

    /**
     * Authorize user from vk array.
     *
     * @param array $userData User array from Vk response
     * @return User
     */
    public function authFromVK(array $userData): User
    {
        $user = $this->getUserInstance($userData);

        auth()->login($user, true);

        return $user;
    }

    /**
     * Get or create user from vk array.
     *
     * @param array $userData User array from Vk response
     * @return User
     */
    private function getUserInstance(array $userData): User
    {
        try {
            return User::where('vk_id', $userData['id'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $user = null;

            DB::transaction(function () use (&$user, $userData) {
                $user = User::create([
                    'vk_id' => $userData['id'],
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name']
                ]);

                UserBalance::create([
                    'user_id' => $user->id
                ]);
            });

            return $user;
        }
    }
}
