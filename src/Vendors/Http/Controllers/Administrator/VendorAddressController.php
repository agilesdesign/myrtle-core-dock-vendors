<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Myrtle\Addresses\Models\Address;
use Myrtle\Addresses\Models\AddressType;
use Myrtle\Vendors\Models\Vendor;

class VendorAddressController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');

		$this->addressTypes = AddressType::pluck('name', 'id');

		$this->countries = collect(json_decode(file_get_contents('https://restcountries.eu/rest/v1/all'), true))->pluck('name', 'alpha2Code');
	}

	public function create(Vendor $vendor, Address $address)
	{
		return view('admin::vendors.addresses.create',
			[
				'address' => $address,
				'addressTypes' => $this->addressTypes,
				'vendor' => $vendor,
				'countries' => $this->countries,
			]
		);
	}

	public function edit(Vendor $vendor, Address $address)
	{
		return view('vendors.addresses.edit',
			[
				'address' => $address,
				'addressTypes' => $this->addressTypes,
				'vendor' => $vendor,
				'countries' => $this->countries,
			]
		);
	}

	public function store(Requests\AddressCreateRequest $request, Vendor $vendor, Address $address)
	{
		$address->fill($request->toArray());
		$address->save();

		$vendor->addresses()->attach($address->id);

		return redirect(route('vendors.show', $vendor->id));
	}

	public function update(Requests\AddressCreateRequest $request, Vendor $vendor, Address $address)
	{
		$address->update($request->toArray());

		return redirect(route('vendors.show', $vendor->id));
	}
}
