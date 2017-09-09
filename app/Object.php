<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Object extends Model 
{

    protected $table = 'objects';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('slug', 'title', 'badgeFPath', 'price', 'address', 'latitude', 'longitude');

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = str_slug($model->id . ' ' . preg_replace_callback('/[\d.]+/', function ($matches) {
                    return round(floatval($matches[0]), 0);
                }, $model->title));
            }
        });
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function assets()
    {
        return $this->hasMany(ObjectAsset::class);
    }

}