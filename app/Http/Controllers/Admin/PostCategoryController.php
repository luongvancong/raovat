<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdminPostCategoryFormRequest;

use Nht\Http\Controllers\Admin\AdminController;

use Nht\Hocs\PostCategories\PostCategoryRepository;


class PostCategoryController extends AdminController
{
	public function __construct(PostCategoryRepository $postCategory)
	{
		parent::__construct();
		$this->postCategory = $postCategory;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
		$categories = $this->postCategory->getCategories();
		return view('admin/post_categories/index', compact('categories'));
	}


	public function getCreate() {
		$data = $this->postCategory->getAllCategories();
		return view('admin/post_categories/create',compact('data'));
	}

	public function postCreate(AdminPostCategoryFormRequest $request) {
		$data = $request->except('_token');

		if( $this->postCategory->create($data) ) {
			return redirect()->back()->with('success', trans('general.messages.create_success'));
		}

		return redirect()->back()->with('error', trans('general.messages.create_fail'));
	}

	public function getEdit($id) {
		$data = $this->postCategory->getAllCategories();
		$category = $this->postCategory->getById($id);
		return view('admin/post_categories/edit', compact('category','data'));
	}

	public function postEdit($id, AdminPostCategoryFormRequest $request) {
		$category = $this->postCategory->getById($id);
		$data = $request->except('_token');
		if( $this->postCategory->update($data, ['id' => $id]) ) {
			return redirect()->route('admin.post_category.index')->with('success', trans('general.messages.update_success'));
		}

		return redirect()->route('admin.post_category.index')->with('error', trans('general.messages.update_fail'));
	}

	public function getDelete($id) {
		$category = $this->postCategory->getById($id);
		$child = $category->getChild;
		foreach ($child as $key => $item_child) {
		    $item_child->delete();
		}
		if($category->delete()) {
			return redirect()->back()->with('success', trans('general.messages.delete_success'));
		}

		return redirect()->back()->with('success', trans('general.messages.delete_fail'));
	}
}
