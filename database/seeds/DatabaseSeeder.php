<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder, this class is
 * used to seed the database with the
 * data for testing purposes.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only seed non user tables
        $this->call(NonUserTablesSeeder::class);
    }
}
