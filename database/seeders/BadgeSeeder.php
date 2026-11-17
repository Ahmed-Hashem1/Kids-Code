<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['first_lesson', 'البداية', 'أول درس', 'lesson_completed', '1'],
            ['five_lessons', 'المثابر', '5 دروس', 'lessons_completed', '5'],
            ['bug_hunter', 'صائد الأخطاء', 'أول إصلاح خطأ صحيح', 'challenge_correct', '1'],
            ['bright_star', 'نجم ساطع', '3 نجوم في 5 تحديات', 'three_stars_in_challenges', '5'],
            ['level_passer', 'عابر المستوى', 'اجتياز مستوى', 'level_passed', '1'],
            ['path_graduate', 'خريج المسار', 'إكمال المسار', 'pathway_completed', '1'],
        ];

        foreach ($badges as [$code, $name, $ruleValue, $ruleType, $threshold]) {
            Badge::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'icon' => "badges/{$code}.svg",
                    'rule_type' => $ruleType,
                    'rule_value' => $threshold,
                ],
            );
        }
    }
}
