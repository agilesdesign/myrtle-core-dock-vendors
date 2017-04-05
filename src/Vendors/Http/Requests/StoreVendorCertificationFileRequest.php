<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreVendorCertificationFileRequest extends FormRequest
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
            'vendor_id' => 'required',
            'type_id' => 'required',
            'certification_file' => 'required',
            'start_at' => 'required',
            'expire_at' => 'required',
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
