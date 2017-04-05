<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;


use App\Http\Controllers\Controller;
use Myrtle\Contacts\Models\Contact;
use Myrtle\Vendors\Http\Requests\VendorContactCreateForm;
use Myrtle\Vendors\Models\Vendor;
use Illuminate\Http\Request;

class VendorContactController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show(Vendor $vendor, Contact $contact)
	{
		return view('admin::vendors.contacts.show', ['contact' => $contact, 'vendor' => $vendor]);
	}

	public function create(Contact $contact, Vendor $vendor)
	{
		return view('admin::vendors.contacts.create', ['contact' => $contact, 'vendor' => $vendor]);
	}

	public function store(VendorContactCreateForm $form, Vendor $vendor)
	{
		$contact = $form->save();

		flasher()->alert('Contact added successfully', 'success');

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}

	public function edit(Vendor $vendor, Contact $contact)
	{
		return view('vendors.contacts.edit', ['contact' => $contact, 'vendor' => $vendor]);
	}

	public function update(Request $request, Vendor $vendor, Contact $contact)
	{
		$contact->update($request->toArray());

		return redirect(url('/vendors/' . $vendor->id . '/contacts/' . $contact->id));
	}
}
