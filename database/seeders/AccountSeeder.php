<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kids.test'],
            [
                'name' => 'مدير المنصة',
                'role' => 'admin',
                'password' => 'password',
                'is_active' => true,
                'must_change_password' => false,
            ],
        );

        $parent = User::updateOrCreate(
            ['email' => 'parent@kids.test'],
            [
                'name' => 'ولي الأمر التجريبي',
                'role' => 'parent',
                'email_verified_at' => now(),
                'password' => 'password',
                'is_active' => true,
                'must_change_password' => false,
            ],
        );

        $childUser = User::updateOrCreate(
            ['username' => 'hero10'],
            [
                'name' => 'بطل البرمجة',
                'email' => null,
                'role' => 'child',
                'password' => 'password',
                'is_active' => true,
                'must_change_password' => true,
            ],
        );

        Child::updateOrCreate(
            ['child_user_id' => $childUser->id],
            [
                'parent_user_id' => $parent->id,
                'display_name' => 'بطل البرمجة',
                'age_group' => '10-12',
                'avatar' => 'avatar-1.png',
            ],
        );
    }
}
