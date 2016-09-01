<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminCitiesFormRequest extends Request
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
            'cit_parent' => 'required',
            'cit_name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'cit_parent.required' => 'Bạn chưa chọn thành phố, vùng miền',
            'cit_name.required' => 'Bạn chưa nhập tên',
        ];
    }
}
