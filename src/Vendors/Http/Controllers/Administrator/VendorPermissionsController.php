<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Core\Docks\Dock;
use Myrtle\Core\Permissions\Models\Ability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Myrtle\Core\Vendors\Models\Vendor;

class VendorPermissionsController extends Controller
{
	public function edit(Vendor $vendor)
	{
		return view('admin::vendors.permissions.edit')
			->withVendor($vendor);
	}

	public function update(Request $request, Vendor $vendor)
	{
        $permissionabletypes = collect(Dock::PERMISSIONABLE_TYPES)->keyBy(function ($type, $key) {
            return $type;
        })->transform(function ($type, $key) {
            return [];
        })->toArray();

		$vendor->abilities->keyBy(function ($ability, $key)
		{
			return $ability->name;
		})->transform(function ($ability, $name) use ($request, $permissionabletypes)
		{
			$fieldName = (str_replace('.', '_', $ability->name));
			$form = $request->{$fieldName} ?? [];

			return array_replace_recursive($form, $permissionabletypes);
		})->each(function ($types, $name)
		{
			collect($types)->each(function ($objectIds, $key) use ($name)
			{
				$ability = Ability::where('name', $name)->first();
				$ability->{$key}()->sync($objectIds);
			});
		});

		flasher()->alert($vendor->legal_name . ' permissions updated successfully', 'success');

		return redirect(route('admin.vendors.permissions.edit', $vendor->id));
	}
}
