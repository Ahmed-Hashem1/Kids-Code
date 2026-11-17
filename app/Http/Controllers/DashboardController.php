<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function redirect(): RedirectResponse
    {
        $user = request()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'parent' => redirect()->route('parent.dashboard'),
            default => $user->must_change_password
                ? redirect()->route('password.change')
                : redirect()->route('learn.dashboard'),
        };
    }

    public function admin(): View
    {
        return view('dashboards.admin');
    }

    public function parent(): View
    {
        return view('dashboards.parent', [
            'children' => request()->user()->children()->with('enrollment')->get(),
        ]);
    }

    public function child(Child $child): View
    {
        Gate::authorize('view', $child);

        return view('dashboards.child', [
            'child' => $child->load(['user', 'enrollment.pathVersion.pathway']),
        ]);
    }

    public function learn(): View
    {
        $child = request()->user()->childProfile;
        abort_unless($child, 403);

        $enrollment = $child->enrollment()->with('pathVersion.pathway')->firstOrFail();
        $enrollment->load([
            'pathVersion.levels.lessons' => fn ($query) => $query
                ->with([
                    'challenge',
                    'progress' => fn ($progress) => $progress->where('enrollment_id', $enrollment->id),
                ])
                ->orderBy('position'),
        ]);

        $completedLessons = $enrollment->lessonProgress()->whereNotNull('completed_at')->count();
        $totalLessons = $enrollment->pathVersion->levels()->withCount('lessons')->get()->sum('lessons_count');
        $badges = $child->childBadges()->with('badge')->orderByDesc('earned_at')->get();

        return view('dashboards.learn', compact('enrollment', 'completedLessons', 'totalLessons', 'badges'));
    }
}
