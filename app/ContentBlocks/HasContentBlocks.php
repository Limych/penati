<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>.
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 14.09.2017
 * Time: 12:10.
 */

namespace Penati\ContentBlocks;

use Illuminate\Database\Eloquent\Model;

trait HasContentBlocks
{
    public function contentBlocks()
    {
        /* @var Model $this */
        return $this->morphMany(ContentBlock::class, 'entity');
    }
}
