<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Locations\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\PHones\Models\Phone;
use Myrtle\Vendors\Models\Vendor;

class VendorLocationPhonesController extends Controller
{
	public function create(Vendor $vendor, Location $location, Phone $phone)
	{
		$this->authorize('locationsEdit', $vendor);

		return view('admin::vendors.locations.phones.create')
			->withVendor($vendor)
			->withLocation($location)
			->withPhone($phone);
	}

	public function store(Request $request, Vendor $vendor, Location $location)
	{
		$this->authorize('locationsEdit', $vendor);

		$location->phones()->create($request->toArray());

		flasher()->alert('Phone added successfully', 'success');

		return redirect(route('admin.vendors.locations.show', [$vendor->id, $location->id]));
	}

	public function edit(Vendor $vendor, Location $location, Phone $phone)
	{
		$this->authorize('locationsEdit', $vendor);

		return view('admin::vendors.locations.phones.edit')
			->withVendor($vendor)
			->withLocation($location)
			->withPhone($phone);
	}

	public function update(Request $request, Vendor $vendor, Location $location, Phone $phone)
	{
		$this->authorize('locationsEdit', $vendor);

		$phone->update($request->toArray());

		flasher()->alert('Phone updated successfully', 'success');

		return redirect(route('admin.vendors.locations.show', [$vendor->id, $location->id]));
	}
}
