<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdvertiseFormRequest extends Request
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
            'name'     => 'required',
            'phone'    => 'required',
            'email'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Bạn phải nhập trường này',
            'phone.required'   => 'Bạn phải nhập trường này',
            'email.required'   => 'Bạn phải nhập trường này'
        ];
    }
    
}
