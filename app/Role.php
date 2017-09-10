<?php

namespace Penati;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'description',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::saving(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = str_slug($model->title);
            }
        });
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->withTimestamps();
    }
}
