<?php

namespace Myrtle\Core\Vendors\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SaveVendorNoteRequest extends FormRequest
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
            'note' => 'required'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
