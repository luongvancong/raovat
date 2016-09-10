<?php

namespace Nht\Hocs\PostCategories;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model {

	protected $guarded = ['id'];

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setCate_Parent($cate_parent) {
		$this->cate_parent = $cate_parent;
	}

	public function getCate_Parent() {
		return $this->cate_parent;
	}

	public function getSlug() {
		if(!$this->slug) {
			return removeTitle(trim($this->getName()));
		}

		return $this->slug;
	}

	public function getUrl() {
		return route('post.category', [$this->getId(), $this->getSlug()]);
	}

	public function getChild(){
		return $this->hasMany('Nht\Hocs\PostCategories\PostCategory', 'cate_parent', 'id');
	}
	public function getParent(){
		return $this->hasOne('Nht\Hocs\PostCategories\PostCategory', 'id', 'cate_parent');
	}

	public function getChildCategory(){
		return $this->hasMany('Nht\Hocs\Posts\Post', 'category_id','id');
	}
}