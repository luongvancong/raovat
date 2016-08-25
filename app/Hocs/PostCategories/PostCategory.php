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

	public function getSlug() {
		if(!$this->slug) {
			return removeTitle(trim($this->getName()));
		}

		return $this->slug;
	}

	public function getUrl() {
		return route('post.category', [$this->getId(), $this->getSlug()]);
	}
}