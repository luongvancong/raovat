<?php

namespace Nht\Hocs\Categories;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Categories\Category;
use Illuminate\Database\DatabaseManager as DBM;

class DbCategoryRepository extends BaseRepository implements CategoryRepository
{
	protected $model;

	public function __construct(Category $model, DBM $db) {
		$this->model    = $model;
		$this->html     = '&rarr; ';
		$this->maskData = array();
		$this->db       = $db;
	}

	public function getListTypeByCategory()
	{
		return [
			Category::PRODUCT    => 'Sản phẩm',
			Category::PAGESTATIC => 'Trang tĩnh',
			Category::NEWS       => 'Tin tức',
			Category::OTHER      => 'Khác',
		];
	}

	/**
	 * Hàm lấy tất cả các danh mục
	 * @param  boolean $list   default: false
	 * @param  array   $params Mảng điều kiện cần lấy
	 * @return array
	 */
	public function getListCategories($list = true, array $params = array()) {

		$slug = array_get($params, 'name');

		$type = (int) array_get($params, 'type');

		$data = $this->model->orderBy('created_at', 'DESC');

		if ($slug) {
			$data->where('slug', removeTitle($slug));
		}

		if ($type) {
			$data->where('type', $type);
		}

		$data = $data->get();

		$this->sort($data, 0, $list);

		return $this->maskData;
	}

	/**
	 * Lấy ra tất cả các danh mục có trạng thái được Active
	 * @param  boolean $list   default: false
	 * @param  array   $conditions[] Mảng điều kiện
	 * @return array
	 */
	public function getAllCategories($list = true, $conditions = array())
	{
		$data = $this->model->where('active', Category::ACTIVE);

		if (!empty($conditions)) {
			foreach ($conditions as $key => $val) {
				$data = $data->where($key, $val);
			}
		}

		$data = $data->orderBy('created_at', 'DESC')->get();

		$this->sort($data, 0, $list);

		return $this->maskData;
	}


	/**
	 * Hàm đệ quy để lấy ra danh mục
	 * @param  [type]  $data   [description]
	 * @param  integer $parent [description]
	 * @param  boolean $list   [description]
	 * @return [type]          [description]
	 */
	public function sort($data, $parent = 0, $list = true)
	{
		if (!empty($data)) {
			foreach ($data as $key => $category) {
				if ($category->parent_id == $parent) {
					$category->mask = ($category->level <= 1) ? $category->name : '|' . str_repeat($this->html, $category->level - 1) . $category->name;
					if ($list) {
						$this->maskData[$category->id] = $category->mask;
					} else {
						array_push($this->maskData, $category);
					}
					$this->sort($data, $category->id, $list);
				}
			}
		}
	}

	/**
	 * Thực thi xóa dữ danh mục đồng thời cập nhập lại level và path cho danh mục
	 * @param  Category $category [ Đối tượng cần xóa]
	 *
	 */
	public function removeCategory($id)
	{
		$category = $this->model->getById($id);
		$this->model->where('path', 'LIKE', $category->path . '%')
		->update([
			'parent_id' => 0,
			'level'     => $this->db->raw('`level` - 2 '),
			'path'      => $this->db->raw('REPLACE(`path`, \'' . $category->path . '\', \'\')')
		]);

		return $category->delete();
	}

	/**
	 * Lấy ra danh mục theo slug
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function getCategoryBySlug($slug) {
		return $this->model->where('slug', $slug)->where('active', Category::ACTIVE)->first();
	}

	/**
	 * Toggle active status
	 *
	 * @param  Categories $categories
	 *
	 * @return Categories
	 */

	public function toggleActiveStatus(Category $category) {
		$category->active = !$category->active;
		return $category->save();
	}

	public function createNewCategory(AdminCategoryRequest $request)
	{
		$data = $request->all();
		$parent_id      = (int) array_get($data, 'parent_id');
		$data['level']  = 1;
		$data['active'] = (int) Category::ACTIVE;
		$data['slug']   = removeTitle(array_get($data, 'name'));
		$category       = $this->model->create($data);

      if ($category) {
         $path = '-' . $category->id . '-';
         if (isset($parent_id) && $parent_id > 0) {
            $parent = $this->model->getById($parent_id, ['path']);
            if (!empty($parent)) {
					$path            = $parent->path . $path;
					$tmp             = explode($this->pathName, $path);
					$category->level = (int) (count($tmp) - 1) / 2;
            }
         }

         $category->path = $path;

         if ($category->save()) {
            return redirect()->route('category.edit', $category->id)->with('success', trans('general.messages.update_success'));
         }
      }
      return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
	}
}