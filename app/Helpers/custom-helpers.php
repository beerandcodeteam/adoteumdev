<?php

if (!function_exists('userIsDeveloper')) {
    function userIsDeveloper(): bool
    {
        $profile = auth()->user()?->profile;

        if ($profile?->provider === 'GITHUB') {
            return true;
        }

        return false;
    }
}

