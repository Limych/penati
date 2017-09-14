<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\ContentBlocks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ContentBlock extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sort_key', 'title', 'summary', 'content',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (get_called_class() === get_class()) {
            $this->fillable[] = 'type';
        }
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            if (empty($model->sort_key)) {
                $latestSortKey =
                    static::where('entity_type', $model->entity_type)
                        ->where('entity_id', $model->entity_id)
                        ->max('sort_key');
                $model->sort_key = intval($latestSortKey) + 1;
            }
        });

        self::saving(function (self $model) {
            if (! $model->isFillable('type')) {
                $model->type = Str::snake(preg_replace('/ContentBlock$/', '', class_basename($model)));
            }
        });
    }
}
