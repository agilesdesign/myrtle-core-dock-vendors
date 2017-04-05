<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Locations\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Addresses\Models\Address;
use Myrtle\Vendors\Models\Vendor;

class VendorLocationAddressesController extends Controller {

	public function create(Vendor $vendor, Location $location, Address $address)
	{
		$this->authorize('locationsEdit', $vendor);

		return view('admin::vendors.locations.addresses.create')
			->withVendor($vendor)
			->withLocation($location)
			->withAddress($address);
	}

	public function store(Request $request, Vendor $vendor, Location $location, Address $address)
	{
		$this->authorize('locationsEdit', $vendor);

		$location->addresses()->create($request->toArray());

		flasher()->alert('Address added successfully', 'success');

		return redirect(route('admin.vendors.locations.show', [$vendor->id, $location->id]));
	}

	public function edit(Vendor $vendor, Location $location, Address $address)
	{
		$this->authorize('locationsEdit', $vendor);

		return view('admin::vendors.locations.addresses.edit')
			->withVendor($vendor)
			->withLocation($location)
			->withAddress($address);
	}

	public function update(Request $request, Vendor $vendor, Location $location, Address $address)
	{
		$this->authorize('locationsEdit', $vendor);

		$address->update($request->toArray());

		flasher()->alert('Address updated successfully', 'success');

		return redirect(route('admin.vendors.locations.show', [$vendor->id, $location->id]));
	}
}
