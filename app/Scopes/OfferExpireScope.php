<?php
/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 12.09.2017
 * Time: 22:56
 */

namespace Penati\Scopes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OfferExpireScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(
            $model->getUpdatedAtColumn(),
            '>=',
            Carbon::now()->subDays(3)->format('Y-m-d H:i:s')
        );
    }
}
