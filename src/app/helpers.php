<?php

use Illuminate\Support\Facades\Auth;

    function getAuthUser()
    {
        $guards = ['candidat', 'web'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard);
            }
        }

        return null;
    }
