<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class UserPostFormRequest extends Request
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
            'category_id'  => 'required',
            'city_id'      => 'required',
            'district_id'  => 'required',
            'active'       => 'required',
            'title'        => 'required',
            'content'      => 'required',
            'price'        => 'required',
            'post_images'  => 'required',
            'van_chuyen'   => 'required',
        ];
    }

    public function messages(){
        return [
            'category_id.required' => 'Bạn chưa chọn chuyên mục',
            'city_id.required'     => 'Bạn chưa chọn vùng miền',
            'district_id.required' => 'Bạn chưa chọn tỉnh, quận, huyện',
            'active.required'      => 'Bạn chưa chọn loại tin',
            'title.required'       => 'Bạn chưa nhập tiêu đề',
            'content.required'     => 'Bạn chưa nhập mô tả',
            'price.required'       => 'Bạn chưa nhập giá',
            'post_images.required' => 'Bạn chưa chọn hình',
            'van_chuyen.required'  => 'Bạn chưa nhập quy trình vận chuyển',
        ];
    }
}
