<?php
/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 07.09.2017
 * Time: 10:38
 */

namespace Penati\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('sortKey');
    }
}