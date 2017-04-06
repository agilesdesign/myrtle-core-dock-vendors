<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;


use App\Http\Controllers\Controller;
use App\Http\Requests\Person\ContactNameUpdateForm;
use App\Models\Contact;
use Myrtle\Core\Vendors\Models\Vendor;

class VendorContactNameController extends Controller {

	public function edit(Vendor $vendor, Contact $contact)
	{
		$this->authorize('contactsEdit', $vendor);

		return view('admin::vendors.contacts.name.edit')
			->withVendor($vendor)
			->withContact($contact);
	}

	public function update(ContactNameUpdateForm $form, Vendor $vendor, Contact $contact)
	{
		$this->authorize('contactsEdit', $vendor);

		$form->save();

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}

}
