<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $isActive = $user?->is_active;

        if ($user?->isChild()) {
            $isActive = $isActive && $user->childProfile?->parent?->is_active;
        }

        if (! $isActive) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'identity' => 'تم تعطيل الحساب أو حساب ولي الأمر المرتبط به.',
            ]);
        }

        return $next($request);
    }
}
