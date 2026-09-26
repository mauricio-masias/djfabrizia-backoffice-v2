<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Admin and reference rows are needed everywhere; demo content only in the
     * local and testing environments (real content comes from the importer).
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ReferenceSeeder::class,
        ]);

        if (app()->environment(['local', 'testing'])) {
            $this->call(DemoContentSeeder::class);
        }
    }
}
