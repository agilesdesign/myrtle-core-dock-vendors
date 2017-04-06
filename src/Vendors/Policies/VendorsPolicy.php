<?php

namespace Myrtle\Core\Vendors\Policies;

use App\User;
use Myrtle\Core\Vendors\Models\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
	{
		if($this->admin($user))
		{
			return true;
		}
	}

	public function accessAdmin(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user)
		{
			return $ability->name === 'vendors.access.admin';
		});
	}

	public function admin(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key)
		{
			return $ability->name === 'vendors.admin';
		});
	}

	public function create(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user)
		{
			return $ability->name === 'vendors.create';
		});
	}

	public function edit(User $user, Vendor $vendor = null)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor)
		{
			return $ability->name === 'vendors.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.edit';
		});
	}

	public function destroy(User $user)
	{
		return $user->allPermissions->contains(function ($ability, $key)
		{
			return $ability->name === 'vendors.delete';
		});
	}

	public function view(User $user, Vendor $vendor = null)
	{
		return $user->allPermissions->contains(function($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.view'
				|| ($vendor && $ability->name === 'vendors.' . $vendor->id . '.view');
		});
	}

	public function commoditiesEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.commodities.create'
			|| $ability->name === 'vendors.' . $vendor->id . '.commodities.create';
		});
	}

	public function biographEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.biograph.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.biograph.edit';
		});
	}

	public function biographView(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.biograph.view'
			|| $ability->name === 'vendors.' . $vendor->id . '.biograph.view'
			|| $this->biographEdit($user, $vendor);
		});
	}
	public function contactsCreate(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.contacts.create';
		});
	}


	public function contactsEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.contacts.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.contacts.edit';
		});
	}

	public function contactsView(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.contacts.view'
			|| $ability->name === 'vendors.' . $vendor->id . '.contacts.view'
			|| $this->biographEdit($user, $vendor);
		});
	}

	public function demographicEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.demographic.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.demographic.edit';
		});
	}

	public function demographicView(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.demographic.view'
			|| $ability->name === 'vendors.' . $vendor->id . '.demographic.view'
			|| $this->demographicEdit($user, $vendor);
		});
	}

	public function governmentEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.government.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.government.edit';
		});
	}

	public function governmentView(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.government.view'
			|| $ability->name === 'vendors.' . $vendor->id . '.government.view'
			|| $this->demographicEdit($user, $vendor);
		});
	}

	public function locationsCreate(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.locations.create';
		});
	}

	public function locationsEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.locations.edit'
			|| $ability->name === 'vendors.' . $vendor->id . '.locations.edit';
		});
	}

	public function locationsView(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.locations.view'
			|| $ability->name === 'vendors.' . $vendor->id . '.locations.view'
			|| $this->locationsEdit($user, $vendor);
		});
	}

	public function nameEdit(User $user, Vendor $vendor)
	{
		return $user->allPermissions->contains(function ($ability, $key) use ($user, $vendor) {
			return $ability->name === 'vendors.name.edit' || $ability->name === 'vendors.' . $vendor->id . '.name.edit';
		});
	}
}
