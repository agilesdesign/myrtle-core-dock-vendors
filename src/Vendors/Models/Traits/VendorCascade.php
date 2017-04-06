<?php

namespace Myrtle\Core\Vendors\Models\Traits;

use Myrtle\Core\Vendors\Models\Vendor;
use Myrtle\Core\Vendors\Observers\VendorObserver;
use Myrtle\Core\Vendors\Observers\VendorCascadeObserver;
use Myrtle\Core\Vendors\Models\Scopes\VendorOrderByNameScope;

trait VendorCascade
{
	public static function bootVendorCascade()
	{
		Vendor::observe(VendorObserver::class);
		Vendor::observe(VendorCascadeObserver::class);

		static::addGlobalScope(new VendorOrderByNameScope);
	}
}