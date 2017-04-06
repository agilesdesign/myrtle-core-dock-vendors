<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Myrtle\Core\Vendors\Models\Vendor;

class UpdateVendorRequest extends FormRequest
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
			'legal_name' => ['required'],
        ];
    }

    public function update(Vendor $vendor)
    {
        $data = collect($this->toArray())->transform(function($data, $key) {
           if(is_string($data) && empty($data))
           {
               return null;
           }
           return $data;
        })->toArray();

        return $vendor->update($data);
    }
}
