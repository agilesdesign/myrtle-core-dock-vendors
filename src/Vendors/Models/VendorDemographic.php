<?php

namespace Myrtle\Core\Vendors\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorDemographic extends Model
{
	use SoftDeletes;

	protected $fillable = ['customers_region', 'customers_domestic', 'customers_foreign', 'fulltime_employees'];
}
