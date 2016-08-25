<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminAdvertiserFromRequest extends Request
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
            'title'         => 'required',
            'link'          => 'required',
            'created_at'    => 'required',
            'expired'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Bạn phải nhập trường này',
            'banner.required'       => 'Bạn phải nhập trường này',
            'link.required'         => 'Bạn phải nhập trường này',
            'created_at.required'   => 'Bạn phải nhập trường này',
            'expired.required'      => 'Bạn phải nhập trường này',
        ];
    }

}
