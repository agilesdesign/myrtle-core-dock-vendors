<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;


use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorGovernmentSaveForm;
use Myrtle\Core\Vendors\Models\Vendor;

class VendorGovernmentController extends Controller {

	public function edit(Vendor $vendor)
	{
		$this->authorize('governmentEdit', $vendor);

		return view('admin::vendors.government.edit')->withVendor($vendor);
	}

	public function update(VendorGovernmentSaveForm $form, Vendor $vendor)
	{
		$this->authorize('governmentEdit', $vendor);

		$form->save($vendor);

		flasher()->alert('Vendor government information updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
