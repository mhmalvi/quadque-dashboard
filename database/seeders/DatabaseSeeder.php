<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@quadque.com',
            'password' => Hash::make('admin')
        ]);

        UserInfo::create([
            'user_id' => $user->id
        ]);
    }
}
