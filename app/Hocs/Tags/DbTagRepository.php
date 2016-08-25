<?php namespace Nht\Hocs\Tags;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Products\Product;
use Xss;

class DbTagRepository extends BaseRepository implements TagRepository {
    public function __construct(Tag $model) {
        $this->model = $model;
    }

    public function take($take = 10) {
        return $this->model->orderBy('id', 'DESC')->take($take)->get();
    }

    public function getPaginated($perPage, array $with = array(), array $filterArray = array(), array $sortArray = array()) {
        $query = $this->model->whereRaw(1)->with($with);

        $name     = Xss::clean(array_get($filterArray, 'name'));
        $position = (array) array_get($filterArray, 'position');

        if($name) {
            $query->where('name', 'LIKE', '%'. $name .'%');
        }

        if($position) {
            $tagIds = \DB::table('tags_positions')->whereIn('position', $position)->lists('tag_id');
            $query->whereIn('id', $tagIds);
        }

        foreach($sortArray as $key => $value) {
            $query->orderBy($key, $value);
        }

        return $query->paginate($perPage);
    }


    public function getPositions(Tag $tag) {
        return \DB::table('tags_positions')->where('tag_id', $tag->getId())->lists('position');
    }


    public function savePositions(Tag $tag, array $positionIds) {
        \DB::table('tags_positions')->where('tag_id', $tag->getId())->delete();
        $dataInsert = [];
        foreach($positionIds as $position) {
            $dataInsert[] = [
                'tag_id' => $tag->getId(),
                'position' => $position
            ];
        }

        if($dataInsert) {
            return \DB::table('tags_positions')->insert($dataInsert);
        }
    }


    public function getByPositions(array $positionIds, $take = 20) {
        $tagIds = \DB::table('tags_positions')->whereIn('position', $positionIds)->lists('tag_id');
        return $this->model->whereIn('id', $tagIds)->orderBy('updated_at', 'DESC')->take($take)->get();
    }


    public function getAllTagsByProduct(Product $product) {
        $tagIds = \DB::table('products_tags')->where('product_id', $product->getId())->lists('tag_id');
        return $this->model->whereIn('id', $tagIds)->orderBy('updated_at', 'DESC')->get();
    }


    public function searchTagByNamePaginated($name, $perPage = 10) {
        return $this->model->where('name', 'LIKE', '%'. $name .'%')
                           ->orderBy('updated_at', 'DESC')
                           ->paginate($perPage);
    }


    public function getByName($name) {
        return $this->model->where('name', $name)->first();
    }

    public function getBySlug($slug) {
        return $this->model->where('slug', $slug)->first();
    }
}