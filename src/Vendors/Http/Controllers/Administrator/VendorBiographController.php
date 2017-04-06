<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Core\Vendors\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorBiographSaveForm;
use Myrtle\Core\Establishments\Models\EstablishmentType;

class VendorBiographController extends Controller
{

	public function edit(Vendor $vendor)
	{
		$this->authorize('biographEdit', $vendor);

		$establishmenttypes = EstablishmentType::pluck('name', 'id');

		return view('admin::vendors.biograph.edit')
			->withVendor($vendor)
			->withBusinesstypes($establishmenttypes);
	}

	public function update(VendorBiographSaveForm $form, Vendor $vendor)
	{
		$this->authorize('biographEdit', $vendor);

		$form->save();

		flasher()->alert('Vendor biograph information updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
