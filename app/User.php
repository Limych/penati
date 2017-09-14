<?php

namespace Penati;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasSlug;
    use HasRolesAndAbilities;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'email', 'password', 'displayName', 'photoFPath', 'slogan', 'description', 'contactUris',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            if (empty($model->displayName)) {
                $model->displayName = $model->name;
            }
            if (empty($model->slug)) {
                $model->slug = $model->makeNewSlug($model->displayName);
            }
        });
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
