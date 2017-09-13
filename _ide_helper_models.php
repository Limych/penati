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
 * Penati\Offer
 *
 * @property int $id
 * @property string $uuid
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
 * @property-read \Penati\User $agent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\OfferAsset[] $assets
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereBadgeFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Offer whereUuid($value)
 */
	class Offer extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\OfferAsset
 *
 * @property int $id
 * @property int $offer_id
 * @property string $slug
 * @property int $sortKey
 * @property string $title
 * @property string $description
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Penati\Offer $offer
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\OfferAsset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset withoutTrashed()
 */
	class OfferAsset extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\User
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $displayName
 * @property string|null $photoFPath
 * @property string|null $slogan
 * @property string|null $description
 * @property string|null $contactUris
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Offer[] $offers
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereContactUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User wherePhotoFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

