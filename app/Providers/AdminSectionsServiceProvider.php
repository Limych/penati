<?php

namespace Penati\Providers;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        //\Penati\User::class => 'Penati\Http\Sections\Users',
    ];

    /**
     * Register sections.
     *
     * @param Admin $admin
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
