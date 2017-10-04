<?php

namespace Penati;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Penati\ContentBlocks\HasContentBlocks;

class Offer extends Model
{
    use HasSlug;
    use HasContentBlocks;

    protected $table = 'offers';
    public $timestamps = true;

    protected $fillable = ['foreign_id', 'slug', 'title', 'badgeFPath', 'price', 'address', 'latitude', 'longitude'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('expire', function (Builder $builder) {
            $model = $builder->getModel();
            $builder->where(
                $model->getUpdatedAtColumn(),
                '>=',
                Carbon::now()->subDays(3)->format('Y-m-d H:i:s')
            );
        });

        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = $model->makeNewSlug(
                    preg_replace('/^Россия,\s+/', '', $model->address),
                    false
                );
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
