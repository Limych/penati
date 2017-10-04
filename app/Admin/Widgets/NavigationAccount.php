<?php

namespace Penati\Admin\Widgets;

use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Navigation\Badge;

class NavigationAccount extends Widget
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return view(AdminTemplate::getViewPath('_partials.widgets.account'), [
            'user' => auth()->user(),
            'pages' => [
                (new Page)->setIcon('fa fa-bell-o')->setUrl('#')->setTitle('Updates')
                    ->setBadge(
                        (new Badge(42))
                            ->setHtmlAttribute('class', 'badge badge-info')
                    ),
                (new Page)->setIcon('fa fa-envelope-o')->setUrl('#')->setTitle('Messages')
                    ->setBadge(
                        (new Badge(64))
                            ->setHtmlAttribute('class', 'badge badge-success')
                    ),
                (new Page)->setTitle('Settings')->setPages(function (Page $page) {
                    $page->addPage(
                        (new Page)->setIcon('fa fa-wrench')->setUrl('#')->setTitle('Settings')
                    );
                    $page->addPage(
                        (new Page)->setIcon('fa fa-rub')->setUrl('#')->setTitle('Payments')
                            ->setBadge(
                                (new Badge(312))
                                    ->setHtmlAttribute('class', 'badge badge-primary')
                            )
                    );
                }),
                (new Page)->setTitle('* * *'),
            ],
        ])->render();
    }

    /**
     * @return string|array
     */
    public function template()
    {
        return AdminTemplate::getViewPath('_partials.header');
    }

    /**
     * @return string
     */
    public function block()
    {
        return 'navbar.right';
    }
}
