<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use App\Http\Requests\Vendor\VendorDemographicSaveForm;
use Myrtle\Vendors\Models\Vendor;
use App\Http\Controllers\Controller;

class VendorDemographicController extends Controller
{
	public function edit(Vendor $vendor)
	{
		$this->authorize('demographicEdit', $vendor);

		return view('admin::vendors.demographic.edit')->withVendor($vendor);
	}

	public function update(VendorDemographicSaveForm $form, Vendor $vendor)
	{
		$this->authorize('demographicEdit', $vendor);

		$form->save($vendor);

		flasher()->alert('Vendor demographic information updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
