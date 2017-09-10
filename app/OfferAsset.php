<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Penati\Scopes\SortScope;

class OfferAsset extends Model
{

    protected $table = 'offer_assets';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('sortKey', 'title', 'description', 'content');

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function (self $model) {
            if (empty($model->sortKey)) {
                $max = self::max('sortKey')->first();
                $model->sortKey = $max->sortKey + 1;
            }
        });
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SortScope());
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}