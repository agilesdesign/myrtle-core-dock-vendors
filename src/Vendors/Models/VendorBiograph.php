<?php

namespace Myrtle\Core\Vendors\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Myrtle\Core\Establishments\Models\EstablishmentType;

class VendorBiograph extends Model
{
	use SoftDeletes;

    protected $fillable = ['established_at', 'business_type_id'];

	protected $dates = ['created_at', 'updated_at', 'established_at'];

	public function businesstype()
	{
		return $this->belongsTo(EstablishmentType::class, 'business_type_id');
	}
}
