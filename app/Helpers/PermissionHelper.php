<?php

if (!function_exists('hasPermission')) {

    function hasPermission(string $permission): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        return $user->user_permission
            ->pluck('slug')
            ->contains($permission);
    }
}