<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Penati\User;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

/**
 * Class Users
 *
 * @property \Penati\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Users extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = true;

    /**
     * @var string
     */
    protected $title = 'Users';

    /**
     * Initialize class.
     */
    public function initialize()
    {
        app()->booted(function() {
            \AdminNavigation::getPages()->findById('access')->addPage(
//            \AdminNavigation::addPage(
                $this->makePage(0, function() {
                    return User::count();
                })
            );
//dd(\AdminNavigation::getPages());
        });
//
//        $this->creating(function($config, \Illuminate\Database\Eloquent\Model $model) {
//            ...
//        });
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'icon-user';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('core.title.users');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
//            ->with('roles')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::link('name', 'Username'),
                AdminColumn::email('email', 'Email')->setWidth('150px'),
//                AdminColumn::lists('roles.label', 'Roles')->setWidth('200px'),
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
            AdminFormElement::password('password', 'Password')->required()->addValidationRule('min:6'),
            AdminFormElement::text('email', 'E-mail')->required()->addValidationRule('email'),
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
