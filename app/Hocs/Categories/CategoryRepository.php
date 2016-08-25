<?php

namespace Nht\Hocs\Categories;

interface CategoryRepository
{
	public function getListTypeByCategory();
	public function getCategoryBySlug($slug);
}