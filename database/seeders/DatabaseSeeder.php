<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AppSeo;
use App\Models\UnitType;

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
            'email' => 'admin@quadque.tech',
            'password' => Hash::make('admin')
        ]);

        UserInfo::create([
            'user_id' => $user->id
        ]);

        /**
         * Seo fields
         */
        $seos = [
            'meta_tile',
            'meta_tags',
            'meta_keys',
            'meta_descriptions',
            'canonical',
            'robots',
            'google_site_verification',
            'ahref_site_verification',
            'gtag_manager_id',
            'og_title',
            'og_site_name',
            'og_local',
            'og_type',
            'og_url'
        ];

        foreach ($seos as $seo) {
            AppSeo::create([
                'name' => $seo
            ]);
        }

        /**
         * Unit Types
         */
        $unitTypes = ['pcs', 'kg', 'gm', 'ltr'];
        foreach ($unitTypes as $value) {
            UnitType::create([
                'unit_type' => $value
            ]);
        }
    }
}
