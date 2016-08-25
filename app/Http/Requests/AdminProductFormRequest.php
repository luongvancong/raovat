<?php

namespace Nht\Http\Requests;

use Nht\Http\Requests\Request;

class AdminProductFormRequest extends Request
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
		$rules = [
			'name'          => 'required',
			'keyword'       => 'required',
			'post_keyword'  => 'required',
			'rate_keyword'  => 'required',
			'video_keyword' => 'required'
		];

      return $rules;
	}

	public function messages()
	{
		$messages = [
			'name.required'         => 'Vui lòng nhập tên sản phẩm',
			'keyword.required'      => 'Vui lòng nhập từ khóa so sánh giá',
			'post_keyword.required' => 'Vui lòng nhập từ khóa tìm kiếm tin tức',
			'rate_keyword.required' => 'Vui lòng nhập từ khóa tìm kiếm đánh giá',
			'video_keyword.required' => 'Vui lòng nhập từ khóa tìm kiếm video'
		];

		return $messages;
	}
}
