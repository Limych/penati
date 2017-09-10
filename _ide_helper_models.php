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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Offer[] $objects
 * @property-read \Penati\Office $office
 * @property-read \Penati\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Agent withoutTrashed()
 */
	class Agent extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Offer
 *
 * @property-read \Penati\Agent $agent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\OfferAsset[] $assets
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Offer onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Offer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Offer withoutTrashed()
 */
	class Offer extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\OfferAsset
 *
 * @property-read \Penati\Offer $offer
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\OfferAsset withoutTrashed()
 */
	class OfferAsset extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Office
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Agent[] $agents
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Penati\Office withoutTrashed()
 */
	class Office extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\User[] $users
 */
	class Role extends \Eloquent {}
}

namespace Penati{
/**
 * Penati\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Penati\Role[] $roles
 */
	class User extends \Eloquent {}
}

