<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Core\Commodities\Models\Commodity;
use Myrtle\Core\Vendors\Http\Requests\UpdateVendorRequest;
use Myrtle\Core\Vendors\Http\Requests\VendorSaveForm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Myrtle\Core\Vendors\Models\Vendor;
use Myrtle\Core\Vendors\Policies\VendorsPolicy;
use Myrtle\Core\Establishments\Models\EstablishmentType;

class VendorController extends Controller
{
	public function index()
	{
		$vendors = Vendor::searched()->canView()->paginate();
		$commodities = Commodity::pluck('name', 'id');
		$businesstypes = EstablishmentType::pluck('name', 'id');

		return view('admin::vendors.index')
			->withVendors($vendors)
			->withCommodities($commodities)
			->withBusinesstypes($businesstypes);
	}

	public function show(Vendor $vendor)
	{
		return view('admin::vendors.show')->withVendor($vendor);
	}

	public function create(Vendor $vendor)
	{
		$this->authorize('create', $vendor);

		$businesstypes = EstablishmentType::pluck('name', 'id');

		return view('admin::vendors.create')
			->withVendor($vendor)
			->withBusinesstypes($businesstypes);
	}

	public function store(VendorSaveForm $form, Vendor $vendor)
	{
		$this->authorize('create', $vendor);

		$form->save();

		flasher()->alert('Vendor created successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}

	public function edit(Vendor $vendor)
	{
		$this->authorize('edit', $vendor);

		$commodities = Commodity::pluck('name', 'id');

		return view('admin::vendors.edit')->withCommodities($commodities)->withVendor($vendor);
	}

	public function update(UpdateVendorRequest $form, Vendor $vendor)
	{
		$this->authorize('edit', $vendor);

		$form->update($vendor);

		flasher()->alert('Vendor updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}

	public function destroy(Request $request, Vendor $vendor)
	{
		$this->authorize('delete', $vendor);

		$vendor->delete();

		return redirect(route('admin.vendors.index'));
	}
}
