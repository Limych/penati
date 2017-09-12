<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Penati\Scopes\OfferExpireScope;

class Offer extends Model
{

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

        static::creating(function ($model) {
            $model->slug = str_slug(preg_replace('/^Россия,\s+/', '', $model->address));

            $latestSlug =
                static::whereRaw("slug = '$model->slug' OR slug LIKE '$model->slug-%'")
                    ->latest('id')
                    ->value('slug');
            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces)) ?: 1;
                $model->slug .= '-' . ($number + 1);
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function assets()
    {
        return $this->hasMany(OfferAsset::class);
    }

}