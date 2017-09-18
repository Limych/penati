<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Penati\ContentBlocks{
/**
 * Penati\ContentBlocks\ContentBlock
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_type
 * @property int $sort_key
 * @property string $type
 * @property string $title
 * @property string|null $summary
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\ContentBlocks\ContentBlock onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\ContentBlock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\ContentBlocks\ContentBlock withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\ContentBlocks\ContentBlock withoutTrashed()
 */
	class ContentBlock extends \Eloquent {}
}

namespace Penati\ContentBlocks{
/**
 * Penati\ContentBlocks\DescriptionContentBlock
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_type
 * @property int $sort_key
 * @property string $type
 * @property string $title
 * @property string|null $summary
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\DescriptionContentBlock whereUpdatedAt($value)
 */
	class DescriptionContentBlock extends \Eloquent {}
}

namespace Penati\ContentBlocks{
/**
 * Penati\ContentBlocks\MapContentBlock
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_type
 * @property int $sort_key
 * @property string $type
 * @property string $title
 * @property string|null $summary
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\MapContentBlock whereUpdatedAt($value)
 */
	class MapContentBlock extends \Eloquent {}
}

namespace Penati\ContentBlocks{
/**
 * Penati\ContentBlocks\PhotosContentBlock
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_type
 * @property int $sort_key
 * @property string $type
 * @property string $title
 * @property string|null $summary
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PhotosContentBlock whereUpdatedAt($value)
 */
	class PhotosContentBlock extends \Eloquent {}
}

namespace Penati\ContentBlocks{
/**
 * Penati\ContentBlocks\PriceContentBlock
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_type
 * @property int $sort_key
 * @property string $type
 * @property string $title
 * @property string|null $summary
 * @property string $content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereSortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\ContentBlocks\PriceContentBlock whereUpdatedAt($value)
 */
	class PriceContentBlock extends \Eloquent {}
}

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\ContentBlocks\ContentBlock[] $contentBlocks
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Ability[] $abilities
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Offer[] $offers
 * @property-read \Illuminate\Database\Eloquent\Collection|\Silber\Bouncer\Database\Role[] $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereContactUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereIs($role)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereIsAll($role)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereIsNot($role)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User wherePhotoFPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Penati\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Penati\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

