<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class UserPasswordFormRequest extends Request
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
            'passCurrent' => 'required',
            'password'    => 'required',
            'rePass'      => 'required|same:password',
        ];
    }

    public function messages(){
        return [
            'passCurrent.required' => 'Bạn chưa nhập mật khẩu hiện tại',
            'password.required'    => 'Bạn chưa nhập mật khẩu mới',
            'rePass.required'      => 'Bạn chưa nhập xác nhận mật khẩu',
            'rePass.same'          => 'Mật khẩu xác nhận không giống',
        ];
    }
}
