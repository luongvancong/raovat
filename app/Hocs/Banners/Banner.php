<?php

namespace Nht\Hocs\Banners;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	protected $guarded    = ['id'];

	// Trạng thái
	const ACTIVE   = 1;
	const DEACTIVE = 0;

	// Vị trí hiển thị.
	const POSITION_TOP    = 'top'; // Top
	const POSITION_RIGHT  = 'right'; // Right
	const POSITION_LEFT   = 'left'; // Left
	const POSITION_BOTTOM = 'bottom'; // Bottom

	const PAGE_HOME = 'home';
	const PAGE_PRODUCT_DETAIL = 'product_detail';

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getTeaser() {
		return $this->teaser;
	}

	public function getPosition() {
		return $this->position;
	}

	public function getPage() {
		return $this->page;
	}

	public function getUrl()
	{
		return $this->link != null ? $this->link : '#';
	}

	public function getLink() {
		return $this->getUrl();
	}

	public function getStatus()
	{
		return $this->status != null ? $this->status : 0;
	}

	public function getImage($value='')
	{
		return PATH_BANNER . $this->image;
	}


	public static function getPositionList() {
		return [
			self::POSITION_TOP    => 'Bên trên',
			self::POSITION_RIGHT  => 'Bên phải',
			self::POSITION_LEFT   => 'Bên trái',
			self::POSITION_BOTTOM => 'Bên dưới',
		];
	}

	public static function getPageList() {
		return [
			self::PAGE_HOME           => 'Trang chủ',
			self::PAGE_PRODUCT_DETAIL => 'Trang chi tiết sản phẩm'
		];
	}

}
