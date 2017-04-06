<?php

namespace Myrtle\Core\Vendors\Models;

use Myrtle\Core\Establishments\Models\Traits\BelongsToEstablishmentType;
use Myrtle\Core\Permissions\Models\Traits\CanView;
use Myrtle\Core\Permissions\Models\Traits\DefinesAbilities;
use Laravel\Scout\Searchable;
use Myrtle\Core\Settings\Models\Traits\Settingable;
use Myrtle\Core\Locations\Models\Traits\Locationable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Vendors\Models\Traits\VendorCascade;
use Myrtle\Core\Commodities\Models\Traits\Commodityable;
use Repertoire\Models\Constants\EloquentDates;
use Repertoire\Models\Traits\CanBeSearched;
use Repertoire\Models\Traits\CreatedBy;
use Repertoire\Models\Traits\DeletedBy;
use Repertoire\Models\Traits\UpdatedBy;

class Vendor extends Model
{
	use BelongsToEstablishmentType,
        CanBeSearched, CanView, Commodityable, CreatedBy,
		DefinesAbilities, DeletedBy,
        Locationable,
        Searchable, Settingable, SoftDeletes,
        UpdatedBy,
		VendorCascade;

	/**
	 * The name of the "deleted at" column.
	 *
	 * @var string
	 */
	protected $dates = [Model::CREATED_AT, Model::UPDATED_AT, EloquentDates::DELETED_AT, EloquentDates::ESTABLISHED_AT];

    protected $fillable = [
        'legal_name', 'previous_legal_names', 'alternative_names', EloquentDates::ESTABLISHED_AT,
        'customers_region', 'customers_domestic', 'customers_foreign', 'fulltime_employees',
        'ein', 'tin', 'duns'
    ];

	protected $with = ['commodities'];

	protected $appends = ['primary_location'];

	protected $casts = ['previous_legal_names' => 'json', 'alternative_names' => 'json'];

	protected $attributes = [
	    'previous_legal_names' => '[]',
        'alternative_names' => '[]',
    ];

	public function getWebsiteAttribute()
    {
        $class = new \stdClass();
        $class->address = null;
        return collect($class);
    }

//	public function website()
//	{
//		return $this->morphOne(Link::class, 'linkable');
//	}

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'legal_name' => $this->legal_name,
        ];
    }
}
