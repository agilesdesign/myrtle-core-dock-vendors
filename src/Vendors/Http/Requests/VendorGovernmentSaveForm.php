<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Myrtle\Establishments\Http\Requests\EstablishmentGovernmentSaveForm;

class VendorGovernmentSaveForm extends EstablishmentGovernmentSaveForm {

	protected $routeParameterKey = 'vendor';
}
