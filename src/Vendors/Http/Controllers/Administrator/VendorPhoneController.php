<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Myrtle\Core\Phones\Models\Phone;
use Myrtle\Core\Vendors\Models\Vendor;
use Myrtle\Core\Phones\Models\PhoneType;

class VendorPhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->phoneTypes = PhoneType::pluck('name', 'id');
    }

    public function create(Vendor $vendor, Phone $phone)
    {
        return view('vendors.phones.create',
            [
                'phone' => $phone,
                'phoneTypes' => $this->phoneTypes,
                'vendor' => $vendor,
            ]
        );
    }

    public function store(Requests\SaveVendorPhoneRequest $request, Vendor $vendor, Phone $phone)
    {
        $phone->fill($request->toArray());
        $phone->save();

        $vendor->phones()->attach($phone->id);

        return redirect(route('vendors.show', $vendor->id));
    }

    public function edit(Vendor $vendor, Phone $phone)
    {
        return view('vendors.phones.edit',
            [
                'phone' => $phone,
                'phoneTypes' => $this->phoneTypes,
                'vendor' => $vendor,
            ]
        );
    }

    public function update(Requests\SaveVendorPhoneRequest $request, Vendor $vendor, Phone $phone)
    {
        $phone->update($request->toArray());

        return redirect(route('vendors.show', $vendor->id));
    }
}