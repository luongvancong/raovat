<?php

namespace Nht\Hocs\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * Định nghĩa constant
	 * Trạng thái:	1: ACTIVE - 2: DEACTIVE - 3: DELETE
	 * Phân loại: 1: PRODUCT - 2: MENU - 3: NEWS - 4: OTHER
	 */
	const ACTIVE     = 1;
	const DEACTIVE   = 2;
	const DELETE     = 3;
	const PRODUCT    = 1;
	const PAGESTATIC = 2;
	const NEWS       = 3;
	const OTHER      = 4;

   /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $table   = 'categories';

	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   public $fillable = ['name', 'slug', 'type', 'parent_id', 'icon', 'background', 'description', 'level', 'active'];

	public function showType()
	{
		switch ($this->getType()) {
			case self::PRODUCT:
				return 'Sản phẩm';

			case self::PAGESTATIC:
				return 'Trang tĩnh';

			case self::NEWS:
				return 'Tin tức';

			default:
				return 'Khác';
		}
	}

	public function showBtnCss()
	{
		switch ($this->getType()) {
			case self::PRODUCT:
				return 'btn-primary';

			case self::PAGESTATIC:
				return 'btn-success';

			case self::NEWS:
				return 'btn-warning';

			default:
				return 'btn-danger';
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getType() {
		return $this->type;
	}

	public function getStatus() {
		return $this->active;
	}
}
