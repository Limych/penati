<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Penati\Scopes\OfferExpireScope;

class Offer extends Model
{

    use HasSlug;

    protected $table = 'offers';
    public $timestamps = true;

    protected $fillable = array('uuid', 'slug', 'title', 'badgeFPath', 'price', 'address', 'latitude', 'longitude');

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfferExpireScope());

        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = $model->makeNewSlug(
                    preg_replace('/^Россия,\s+/', '', $model->address)
                );
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }

    public function assets()
    {
        return $this->hasMany(OfferAsset::class);
    }

}