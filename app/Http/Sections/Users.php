<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>.
 */

namespace Penati\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Limych\SleepingOwlCoreUI\Navigation\Badge;
use Penati\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Users.
 *
 * @property \Penati\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->title = trans('http.sections.users');
        $this->setIcon('icon-user');

        $this->enableAccessCheck();

        app()->booted(function () {
            \AdminNavigation::getPages()->findById('access')->addPage(
//            \AdminNavigation::addPage(
                $this->makePage(0, new Badge(function () {
                    try {
                        return User::count();
                    } catch (\Exception $ex) {
                        return 0;
                    }
                }))
            );
        });
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'bg-default')
            ->setColumns([
                AdminColumn::link('name', trans('http.display.username')),
                AdminColumn::email('email', trans('http.display.email'))->setView('column.account_email')->setWidth('150px'),
                AdminColumn::lists('roles.name', trans('http.display.roles'))->setWidth('200px'),
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminColumn::image('avatar')->setWidth('150px'),
            AdminFormElement::upload('avatar', 'Avatar')->addValidationRule('image'),
            AdminFormElement::text('name', 'Username')->required(),
            AdminFormElement::text('email', 'E-mail')->required()->addValidationRule('email'),
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
//            AdminFormElement::multiselect('roles', 'Roles', Role::class)->setDisplay('name'),
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
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
