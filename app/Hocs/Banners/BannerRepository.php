<?php

namespace Nht\Hocs\Banners;

interface BannerRepository {
	/**
	 * Lấy banner
	 *
	 * @param  integer $take     Số lượng cần lấy
	 * @param  string  $position Vị trí
	 * @param  string  $page     Trang đích
	 *
	 * @return Collection
	 */
	public function getBanners($take = 5, $position, $page);
}