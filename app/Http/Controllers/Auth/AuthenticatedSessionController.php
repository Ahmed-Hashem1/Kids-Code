<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'identity' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $identity = trim($validated['identity']);
        $user = str_contains($identity, '@')
            ? User::where('email', $identity)->whereIn('role', ['admin', 'parent'])->first()
            : User::where('username', $identity)->where('role', 'child')->first();

        if (! $user || ! Hash::check($validated['password'], $user->password) || ! $this->accountsAreActive($user)) {
            return back()->withErrors([
                'identity' => 'بيانات الدخول غير صحيحة.',
            ])->onlyInput('identity');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ($user->isParent() && ! $user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        if ($user->isChild() && $user->must_change_password) {
            return redirect()->route('password.change');
        }

        return redirect()->intended($this->dashboardFor($user));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function accountsAreActive(User $user): bool
    {
        if (! $user->is_active) {
            return false;
        }

        if ($user->isChild()) {
            return (bool) $user->childProfile?->parent?->is_active;
        }

        return true;
    }

    private function dashboardFor(User $user): string
    {
        return match ($user->role) {
            'admin' => route('admin.dashboard'),
            'parent' => route('parent.dashboard'),
            default => route('learn.dashboard'),
        };
    }
}
