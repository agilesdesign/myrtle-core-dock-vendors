<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Core\Locations\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Vendors\Models\Vendor;

class VendorLocationController extends Controller
{
	public function index(Vendor $vendor)
	{
		return view('admin::vendors.locations.index')
			->withVendor($vendor)
			->withLocations($vendor->locations()->paginate());
	}

	public function show(Vendor $vendor, Location $location)
	{
		return view('admin::vendors.locations.show')
			->withVendor($vendor)
			->withLocation($location);
	}

	public function create(Vendor $vendor, Location $location)
	{
		$this->authorize('locationsCreate', $vendor);

		return view('admin::vendors.locations.create')
			->withVendor($vendor)
			->withLocation($location);
	}

	public function store(Request $request, Vendor $vendor)
	{
		$this->authorize('locationsCreate', $vendor);

		$location = $vendor->locations()->create($request->toArray());

		flasher()->alert('Location added successfully', 'success');

		return redirect(route('admin.vendors.locations.show', [$vendor->id, $location->id]));
	}

	public function edit(Vendor $vendor, Location $location)
	{
		$this->authorize('locationsEdit', $vendor);

		return view('admin::vendors.locations.edit')
			->withVendor($vendor)
			->withLocation($location);
	}

	public function update(Request $request, Vendor $vendor, Location $location)
	{
		$this->authorize('locationsEdit', $vendor);

		$location->update($request->toArray());

		flasher()->alert('Location updated successfully', 'success');

		return redirect(route('admin.vendors.locations.index', $vendor->id));

	}
}
