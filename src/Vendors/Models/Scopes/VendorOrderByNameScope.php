<?php

namespace Myrtle\Core\Vendors\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class VendorOrderByNameScope implements Scope
{
	public function apply(Builder $builder, Model $model)
	{
		return;
	}
}
