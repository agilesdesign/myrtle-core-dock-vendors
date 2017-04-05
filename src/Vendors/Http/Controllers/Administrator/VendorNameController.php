<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Vendors\Models\Vendor;

class VendorNameController extends Controller
{
    public function edit(Vendor $vendor)
	{
		$this->authorize('nameEdit', $vendor);

		return view('admin::vendors.name.edit')
			->withVendor($vendor);
	}

	public function update(Request $request, Vendor $vendor)
	{
		$this->authorize('nameEdit', $vendor);

		$vendor->name->update($request->except(['_token', '_method']));

//		flash()->alert('Vendor name updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
