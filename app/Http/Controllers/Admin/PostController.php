<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdminPostFormRequest;

use Nht\Http\Controllers\Admin\AdminController;

use Nht\Hocs\Posts\DbPostRepository;

class PostController extends AdminController
{
	public function __construct(DbPostRepository $post)
	{
		parent::__construct();
		$this->post = $post;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
		$posts = $this->post->getPosts(25, $request->all());
		return view('admin/posts/index', compact('posts'));
	}

	public function getEdit($postId) {
		$post = $this->post->getById($postId);
		return view('admin/posts/edit', compact('post'));
	}

	public function postEdit($postId, AdminPostFormRequest $request) {
		$post = $this->post->getById($postId);
		$data = $request->except('_token');
		if( $this->post->update($data, ['id' => $postId]) ) {
			return redirect()->route('admin.post.index')->with('success', trans('general.messages.update_success'));
		}

		return redirect()->route('admin.post.index')->with('error', trans('general.messages.update_fail'));
	}

	public function getDelete($postId) {
		$post = $this->post->getById($postId);

		if($post->delete()) {
			return redirect()->back()->with('success', trans('general.messages.delete_success'));
		}

		return redirect()->back()->with('success', trans('general.messages.delete_fail'));
	}


	public function tagIndex($postId)
	{
		$post = $this->post->getById($postId);
		$tags = $post->tags()->get();

		return view('admin/posts/tag/index', compact('post', 'tags'));
	}


	public function tagCreate($postId)
	{
		$post = $this->post->getById($postId);
		return view('admin/posts/tag/create', compact('post'));
	}


	public function tagCreateStore($postId, Request $request)
	{
		$post = $this->post->getById($postId);
		$tags = explode(',', $request->get('tags'));
		$post->tags()->attach($tags);
		return redirect()->back()->with('success', 'Thêm tag thành công');
	}


	public function tagDelete($postId, $tagId)
	{
		\DB::table('posts_tags')->where('post_id', $postId)->where('tag_id', $tagId)->delete();
		return redirect()->back()->with('success', 'Xóa thành công');
	}
}
