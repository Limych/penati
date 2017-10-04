<?php

namespace Penati\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Penati\Http\Sections\Users;
use Penati\User;

class UsersSectionModelPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Users $section, User $item = null)
    {
        if ($user->roles->has('admin')) {
            if ($ability != 'display' && $ability != 'create' && !is_null($item) && $item->id < 2) {
                return false;
            }

            return true;
        }
    }

    /**
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, Users $section, User $item)
    {
        return true;
    }

    /**
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, Users $section, User $item)
    {
        return $item->id >= 2;
    }

    /**
     * @param User $user
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function delete(User $user, Users $section, User $item)
    {
        return $item->id >= 2;
    }
}