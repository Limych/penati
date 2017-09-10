<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model 
{

    protected $table = 'agents';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('slug', 'fullName', 'displayName', 'photoFPath', 'slogan', 'description', 'contactUris');

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = str_slug($model->fullName);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function objects()
    {
        return $this->hasMany(Offer::class);
    }

}