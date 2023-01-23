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
            CategorySeeder::class,
            AuthorSeeder::class,
            LanguageSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            BookCategorySeeder::class,
            RoleSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
