<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        // Jika admin sudah login, bypass maintenance
        if (Auth::check()) {
            return $next($request);
        }

        $profile = Profile::first();

        if ($profile && $profile->maintenance_mode) {
            return response()->view('maintenance', [
                'pesan' => $profile->maintenance_pesan,
                'profile' => $profile,
            ], 503);
        }

        return $next($request);
    }
}
