<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;


use Myrtle\Phones\Models\Phone;
use Myrtle\Phones\Models\PhoneType;
use Myrtle\Vendors\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class VendorContactPhoneController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');

		$this->phoneTypes = PhoneType::pluck('name', 'id');
	}

	public function create(Vendor $vendor, Contact $contact, Phone $phone)
	{
		return view('admin::vendors.contacts.phones.create', ['vendor' => $vendor, 'contact' => $contact, 'phone' => $phone, 'phoneTypes' => $this->phoneTypes]);
	}

	public function store(Request $request, Vendor $vendor, Contact $contact, Phone $phone)
	{
		$contact->phones()->create($request->toArray());

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}

	public function edit(Vendor $vendor, Contact $contact, Phone $phone)
	{
		return view('admin::vendors.contacts.phones.edit', ['phone' => $phone, 'phoneTypes' => $this->phoneTypes, 'contact' => $contact, 'vendor' => $vendor]);
	}

	public function update(Request $request, Vendor $vendor, Contact $contact, Phone $phone)
	{
		$phone->update($request->toArray());

		return redirect(route('admin.vendors.contacts.show', [$vendor, $contact]));
	}
}
