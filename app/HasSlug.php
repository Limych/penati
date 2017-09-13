<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 0:37
 */

namespace Penati;

trait HasSlug
{

    protected function makeNewSlug($seed)
    {
        $slug = str_slug($seed);
        $latestSlug =
            static::whereRaw("slug = '$slug' OR slug LIKE '$slug-%'")
                ->latest('id')
                ->value('slug');
        if ($latestSlug) {
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces)) ?: 1;
            $slug .= '-' . ($number + 1);
        }

        return $slug;
    }
}