<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class UserRegisterFormRequest extends Request
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
            'email'    => 'required|unique:users,email',
            'password' => 'required',
            'phone'    => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'     => 'Bạn chưa nhập tên',
            'email.required'    => 'Bạn chưa nhập email',
            'email.unique'      => 'Email này đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'phone.required'    => 'Bạn chưa nhập số điện thoại'
        ];
    }
}
