<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminPostCategoryFormRequest extends Request
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
			'cate_parent' => 'required',
			'name' => 'required',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Vui lòng nhập tên',
			'cate_parent.required' => 'Vui lòng chọn danh mục'
		];
	}
}
