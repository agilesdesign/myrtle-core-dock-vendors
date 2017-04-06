<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Core\Vendors\Models\Vendor;

class VendorSettingsController extends Controller
{
	public function edit(Vendor $vendor)
	{
		$this->authorize('edit', $vendor);

		return view('admin::vendors.settings.edit')
			->withVendor($vendor)
			->withLocations($vendor->locations()->pluck('name', 'id'));
	}

	public function update(Request $request, Vendor $vendor)
	{
		$this->authorize('edit', $vendor);

		$vendor->settings->update(['options' => $request->except(['_token', '_method'])]);

		flasher()->alert('Settings updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
