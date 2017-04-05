<?php

namespace Myrtle\Core\Vendors\Models\Traits;

use Myrtle\Vendors\Models\Vendor;
use Myrtle\Vendors\Observers\VendorObserver;
use Myrtle\Vendors\Observers\VendorCascadeObserver;
use Myrtle\Vendors\Models\Scopes\VendorOrderByNameScope;

trait VendorCascade
{
	public static function bootVendorCascade()
	{
		Vendor::observe(VendorObserver::class);
		Vendor::observe(VendorCascadeObserver::class);

		static::addGlobalScope(new VendorOrderByNameScope);
	}
}