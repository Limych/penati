<?php

namespace Penati\Providers;

use Illuminate\Console\DetectsApplicationNamespace;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    use DetectsApplicationNamespace;

    /**
     * @var array
     */
    protected $widgets = [
//        \Penati\Admin\Widgets\DashboardMap::class,
//        \Penati\Admin\Widgets\NavigationNotifications::class,
        \Penati\Admin\Widgets\NavigationAccount::class,
    ];

    /**
     * @var array
     */
    protected $sections = [
        \Penati\User::class => 'Penati\Http\Sections\Users',
    ];

    /**
     * @param null $namespace
     * @return array
     */
    public function policies($namespace = null)
    {
        if (is_null($namespace)) {
            $namespace = config('sleeping_owl.policies_namespace', $this->getAppNamespace().'Policies\\');
        }

        return parent::policies($namespace);
    }

    /**
     * Register sections.
     *
     * @param Admin $admin
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
        $this->registerPolicies();

        parent::boot($admin);

        $this->app->call([$this, 'registerViews']);
    }

    public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
    {
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
    }
}
