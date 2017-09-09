<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Penati{
/**
 * Penati\Agent
 *
 * @property int $id
 * @property string $slug
 * @property int $office_id
 * @property int|null $user_id
 * @property string $fullName
 * @property string $displayName
 * @property string|null $photoFPath
 * @property string|null $slogan
 * @property string|null $description
 * @property string $contactUris
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Object[] $objects
 * @property-read \Penati\Office $office
 * @property-read \Penati\User|null $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereContactUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereOfficeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent wherePhotoFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Agent whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent withoutTrashed()
 */
	class Agent extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Object
 *
 * @property int $id
 * @property string $slug
 * @property int $agent_id
 * @property string $title
 * @property string|null $badgeFPath
 * @property string $price
 * @property string $address
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Penati\Agent $agent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\ObjectAsset[] $assets
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Object onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereBadgeFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Object whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\Object withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Object withoutTrashed()
 */
	class Object extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\ObjectAsset
 *
 * @property int $id
 * @property int $object_id
 * @property string $slug
 * @property int $sortKey
 * @property string $title
 * @property string $description
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Penati\Object $object
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\ObjectAsset onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ObjectAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\ObjectAsset withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\ObjectAsset withoutTrashed()
 */
	class ObjectAsset extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Office
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string|null $logotypeFPath
 * @property string|null $slogan
 * @property string|null $description
 * @property string $contactUris
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Agent[] $agents
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereContactUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereLogotypeFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Office whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office withoutTrashed()
 */
	class Office extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

