<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role MUST always comes before User seeder here.
        $this->call(RoleTableSeeder::class);
    }
}
