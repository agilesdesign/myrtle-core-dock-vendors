<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Vendors\Models\Vendor;
use Myrtle\Core\Commodities\Models\Commodity;

class VendorCommoditiesController extends Controller
{
    public function edit(Vendor $vendor)
	{
		$commodities = Commodity::pluck('name', 'id');

		return view('admin::vendors.commodities.edit')
			->withVendor($vendor)
			->withCommodities($commodities);
	}

	public function update(Request $request, Vendor $vendor)
	{

		$vendor
			->commodities()
				->sync($request->only('commodities')['commodities'] ?? []);

		flasher()->alert('Vendor commodities updated successfully', 'success');

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
