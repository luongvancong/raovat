<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Controllers\Controller;
use Nht\Hocs\Categories\Category;
use Nht\Hocs\Categories\CategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
        $this->type      = $category->getListTypeByCategory();
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $type       = $this->type;
        $category   = $this->category->getListCategories(false, $request->all());
        return view('admin/categories/index', compact('category', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $type       = $this->type;
        $categories = $this->category->getAllCategories(false);
        return view('/admin/categories/create', compact('type', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AdminCategoryRequest $request)
    {
        $data = (array) $request->all();
        $parent_id      = (int) array_get($data, 'parent_id');
        $data['level']  = 1;
        $data['active'] = (int) Category::ACTIVE;
        $data['slug']   = removeTitle(array_get($data, 'name'));
        $category       = $this->category->create($data);

        if ($category) {
            $path = $this->pathName . $category->id . $this->pathName;
            if (isset($parent_id) && $parent_id > 0) {
                $parent = $this->category->getById($parent_id, ['path']);
                if (!empty($parent)) {
                    $path            = $parent->path . $path;
                    $tmp             = explode($this->pathName, $path);
                    $category->level = (int)(count($tmp) - 1) / 2;
                }
            }
            $category->path = $path;

            if ($category->save()) {
                return redirect()->route('category.edit', $category->id)->with('success', trans('general.messages.update_success'));
            }
        }
        return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category   = $this->category->getById($id);
        $categories = $this->category->getAllCategories(false);
        $type       = $this->type;
        return view('admin/categories/edit', compact('type', 'category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, AdminCategoryRequest $request)
    {
        $category   = $this->category->getById($id);
        return $this->updater->updateCategory($this, $request->except('_token'), $category);
    }

    /**
     * Update the active category in storage
     * @param  int  $id
     * @return Response
     */

    public function active($id)
    {
        $category   = $this->category->getById($id);
        return $this->updater->toggleActiveStatus($this, $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
