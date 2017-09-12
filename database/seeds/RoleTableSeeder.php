<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

use Illuminate\Database\Seeder;
use Penati\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'slug' => str_slug('admin'),
            'title' => 'Administrator',
            'description' => 'An administrator user.',
        ]);
        Role::create([
            'title' => 'Agent',
            'description' => 'An agent user.',
        ]);
        Role::create([
            'title' => 'Client',
            'description' => 'A client user.',
        ]);
    }
}
