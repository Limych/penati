<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 3:08
 */

class RolesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('agent')->to('post-offers');
    }
}