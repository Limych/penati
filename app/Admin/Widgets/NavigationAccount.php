<?php

namespace Penati\Admin\Widgets;

use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;

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
            'user' => auth()->user()
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
