<?php

namespace Penati\Http\Sections;

use AdminColumn;
use AdminDisplay;
use Limych\SleepingOwlCoreUI\Navigation\Badge;
use Penati\Offer;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Offers
 *
 * @property \Penati\Offer $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Offers extends Section implements Initializable
{
    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->title = trans('http.sections.offers');
        $this->setIcon('icon-home');

        app()->booted(function () {
            \AdminNavigation::addPage(
                $this->makePage(100, new Badge(Offer::count()))
            );
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->with(['agent'])
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::link('title', trans('http.display.title')),
                AdminColumn::text('agent.name', trans('http.display.agent')),
                AdminColumn::text('address', trans('http.display.address')),
                AdminColumn::text('price', trans('http.display.price')),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
