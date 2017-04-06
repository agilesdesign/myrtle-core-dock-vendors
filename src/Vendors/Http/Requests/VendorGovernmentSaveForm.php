<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Myrtle\Core\Establishments\Http\Requests\EstablishmentGovernmentSaveForm;

class VendorGovernmentSaveForm extends EstablishmentGovernmentSaveForm {

	protected $routeParameterKey = 'vendor';
}
