<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use App\Models\Contact;
use App\Models\Email;
use Myrtle\Vendors\Models\Vendor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VendorContactEmailController extends Controller
{
	public function create(Vendor $vendor, Contact $contact, Email $email)
	{
		$this->authorize('contactsEdit', $vendor);

		return view('admin::vendors.contacts.emails.create')->withVendor($vendor)->withContact($contact)->withEmail($email);
	}

	public function store(Request $request, Vendor $vendor, Contact $contact)
	{
		$this->authorize('contactsEdit', $vendor);

		$contact->emails()->create($request->toArray());

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}

	public function edit(Vendor $vendor, Contact $contact, Email $email)
	{
		$this->authorize('contactsEdit', $vendor);

		return view('admin::vendors.contacts.emails.edit')
			->withVendor($vendor)
			->withContact($contact)
			->withEmail($email);
	}

	public function update(Request $request, Vendor $vendor, Contact $contact, Email $email)
	{
		$this->authorize('contactsEdit', $vendor);

		$email->update($request->toArray());

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}
}
