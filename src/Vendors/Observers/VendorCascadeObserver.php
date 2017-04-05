<?php

namespace Myrtle\Core\Vendors\Observers;

use Myrtle\Vendors\Models\Vendor;

class VendorCascadeObserver
{

	public function deleting(Vendor $vendor)
	{
		$method = $vendor->isForceDeleting() ? 'forceDelete' : 'delete';

		$vendor->biograph->$method();
		$vendor->demographic->$method();
		$vendor->contacts->each(function ($contact, $key) use ($method)
		{
			$contact->$method();
		});
		$vendor->government->$method();
		//$vendor->website->$method();

		if ($method === 'forceDelete')
		{
			$vendor->commodities->sync([]);
		}
	}

	public function restoring(Vendor $vendor)
	{
		$vendor->biograph()->withTrashed()->restore();
		$vendor->demographic()->withTrashed()->restore();
		$vendor->contacts()->withTrashed()->get()->each(function ($contact, $key)
		{
			$contact->restore();
		});
		$vendor->government()->withTrashed()->restore();
		//$vendor->website()->withTrashed()->restore();

		// commodities
	}
}