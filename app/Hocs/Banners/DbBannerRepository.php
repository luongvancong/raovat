<?php

namespace Nht\Hocs\Banners;

use Nht\Hocs\Core\BaseRepository;

class DbBannerRepository extends BaseRepository implements BannerRepository {

	public function __construct(Banner $model)
	{
		$this->model = $model;
	}

	public function getBanners($take = 5, $position, $page) {
		return $this->model->where('status', Banner::ACTIVE)
								 ->where('position', trim($position))
								 ->where('page', trim($page))
								 ->take(5)
								 ->get();
	}

}