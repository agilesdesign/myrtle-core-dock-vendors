<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Myrtle\Vendors\Models\Vendor;

class VendorDemographicSaveForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function save(Vendor $vendor)
	{
		$vendor->demographic->update($this->toArray());
	}
}
