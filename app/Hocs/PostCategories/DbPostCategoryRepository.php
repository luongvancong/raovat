<?php namespace Nht\Hocs\PostCategories;

use Nht\Hocs\Core\BaseRepository;

class DbPostCategoryRepository extends BaseRepository implements PostCategoryRepository{
	public function __construct(PostCategory $model) {
		$this->model = $model;
	}

	public function getCategories($perPage = 25, $filterArray = array()) {
		$name = array_get($filterArray, 'name');
		$query = $this->model->whereRaw(1);

		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		$query->orderBy('updated_at', 'DESC');

		return $query->paginate($perPage);
	}

	public function getAllCategories() {
		return $this->model->orderBy('name', 'ASC')->get();
	}

	public function getCategoriesParent(){
		return $this->model->where('cate_parent', 0)->orderBy('id', 'ASC')->get();
	}

	public function getCatechildByCityId($categoryId) {
        $catechild = $this->model->where('cate_parent', $categoryId)->get();
        return $catechild;
    }

    public function getCategoryId($category_id){
    	$category_child_all_id = $this->model->select('id')->where('cate_parent', $category_id)->get();
    	return $category_child_all_id;
    }
}