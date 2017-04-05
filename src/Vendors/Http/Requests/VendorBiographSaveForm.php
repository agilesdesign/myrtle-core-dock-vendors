<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Myrtle\Establishments\Http\Requests\EstablishmentBiographSaveForm;

class VendorBiographSaveForm extends EstablishmentBiographSaveForm
{
	protected $routeParameterKey = 'vendor';
}
