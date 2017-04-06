<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Myrtle\Core\Vendors\Models\Vendor;
use Illuminate\Foundation\Http\FormRequest;

class VendorSaveForm extends FormRequest
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
            'legal_name' => ['required']
        ];
    }

    public function save()
	{
		Vendor::create([
		    'legal_name' => $this->legal_name,
            'previous_legal_names' => $this->previous_legal_names ?? [],
        ]);
	}
}
