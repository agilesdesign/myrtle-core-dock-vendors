<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Vendors\Models\Vendor;

class VendorWebsiteController extends Controller
{
    public function edit(Vendor $vendor)
	{
		$this->authorize('editWebsite', $vendor);

		return view('admin::vendors.website.edit')->withVendor($vendor);
	}

	public function update(Request $request, Vendor $vendor)
	{
		$this->authorize('editWebsite', $vendor);

		$this->process($request, $vendor);

		return redirect(route('admin.vendors.show', $vendor));
	}

	protected function process(Request $request, Vendor $vendor)
	{
		if($address = empty($request->address) ? null : $request->address)
		{
			if($vendor->website)
			{
				$vendor->website->update(['address' => $request->address]);
			}
			else
			{
				$vendor->website()->create(['address' => $request->address]);
			}
		}
		else
		{
			$vendor->website->forceDelete();
		}
	}
}
