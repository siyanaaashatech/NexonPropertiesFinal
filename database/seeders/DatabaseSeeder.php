<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            Role_PermissionSeeder::class,
            UserSeeder::class,
            MetadataTableSeeder::class,
            SocialLinksTableSeeder::class,
            SiteSettingsTableSeeder::class,
            FaviconsTableSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            AmenitySeeder::class,
            AddressSeeder::class,
        ]);
    }
}
