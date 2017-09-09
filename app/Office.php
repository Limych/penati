<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model 
{

    protected $table = 'offices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('slug', 'title', 'logotypeFPath', 'slogan', 'description', 'contactUris');

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = str_slug($model->title);
            }
        });
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

}