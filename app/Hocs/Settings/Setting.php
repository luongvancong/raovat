<?php

namespace Nht\Hocs\Settings;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Model Setting
 * @author SaturnLai - daolvcntt@gmail.com
 */
class Setting extends Model
{
   /**
	* The database table used by the model.
	*
	* @var string
	*/
	public $timestamps 	= false;

	public function getLogo($type = 'md_')
	{
		return $this->logo != null ? LOGO_SETTING . $type . $this->logo : '/images/no-image.png';
	}
}
