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
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'An administrator user.',
        ]);
        Role::create([
            'name' => 'agent',
            'display_name' => 'Agent',
            'description' => 'An agent user.',
        ]);
        Role::create([
            'name' => 'client',
            'display_name' => 'Client',
            'description' => 'A client user.',
        ]);
    }
}
