<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\ContentBlocks;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * An array to map class names to their block types in database.
     *
     * @var array
     */
    protected static $modelMap = [];

    /**
     * ContentBlock constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (empty(static::$modelMap)) {
            $ereg =  '/(.+)' . preg_quote(basename(__FILE__), '/') . '/';
            foreach (scandir(__DIR__) as $fname) {
                if (is_file(__DIR__ . '/' . $fname) && preg_match($ereg, $fname, $matches)) {
                    static::$modelMap[Str::snake($matches[1])] =
                        __NAMESPACE__ . '\\' . $matches[1] . class_basename(__CLASS__);
                }
            }
        }

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
                    static::withoutGlobalScopes()
                        ->where('entity_type', $model->entity_type)
                        ->where('entity_id', $model->entity_id)
                        ->max('sort_key');
                $model->sort_key = intval($latestSortKey) + 1;
            }
        });

        self::saving(function (self $model) {
            if (get_class($model) !== self::class) {
                $model->type = array_search(get_class($model), static::$modelMap) ?: get_class($model);
            }
        });

        self::addGlobalScope('type', function (Builder $builder) {
            $model = $builder->getModel();
            if (get_class($model) !== self::class) {
                $builder->where(
                    'type',
                    array_search(get_class($model), static::$modelMap) ?: get_class($model)
                );
            }
        });

        self::addGlobalScope('sort', function (Builder $builder) {
            $builder->orderBy('sort_key');
        });
    }

    /**
     * Create a new model instance that is existing.
     *
     * @param array $attributes
     * @param null $connection
     * @return static
     */
    public function newFromBuilder($attributes = [], $connection = null)
    {
        if ((get_class($this) === self::class) && ! empty($attributes->type)
            && ($class = static::$modelMap[$attributes->type])
        ) {
            return (new $class)->newFromBuilder($attributes, $connection);
        } else {
            return parent::newFromBuilder($attributes, $connection);
        }
    }

    public function html()
    {
        $title = $this->title;
        $summary = $this->summary;
        $content = $this->content;

        $view = view('block.basic', compact('title', 'summary', 'content'));
        return $view->render();
    }
}
