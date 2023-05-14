<?php

namespace App\Http\Middleware;

use DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Check if there are any users in the database
            $userCount = DB::table('users')->count();

            if ($userCount == 0) {
                return route('install');
            }

            return route('login');
        }
    }
}
