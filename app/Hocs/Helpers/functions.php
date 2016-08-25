<?php
/**
 * Make Delete Button
 *
 * @param  url $link
 * @return html
 */
function makeDeleteButton($link) {
	return '<a class="btn btn-xs btn-danger btn-delete-action" href="'. $link .'"><i class="fa fa-trash-o"></i></a>';
}


/**
 * Make Edit button
 *
 * @param  url $link
 * @return html
 */
function makeEditButton($link) {
	return '<a class="btn btn-xs btn-default" href="'. $link .'"><i class="fa fa-pencil"></i></a>';
}


/**
 * Make active button
 *
 * @param  url $link
 * @param  integer $currentActiveValue
 * @return html
 */
function makeActiveButton($link, $currentActiveValue) {
	$classActive = $currentActiveValue == 1 ? 'fa-check-square' : 'fa-square-o';
	return '<a class="btn-action btn-xs btn-active-action" href="'. $link .'"><i class="fa '. $classActive .' fa-2x"></i></a>';
}


/**
 * Convert ngÃ y thÃ¡ng sang unixtimestamp
 *
 * @param  string $dateStr  Chuá»—i Ä‘á»‹nh dáº¡ng ngÃ y thÃ¡ng
 * @param  string $hour     Chuá»—i Ä‘á»‹nh dáº¡ng giá»::phÃºt::giÃ¢y ná»‘i vÃ o Ä‘á»ƒ láº¥y time chÃ­nh xÃ¡c
 *
 * @return unixtimestamp
 */
function convertDateToTime($dateStr, $hour = '00:00:00') {
	$dateStr = str_replace('/', '-', $dateStr);
	return strtotime($dateStr . ' ' . trim($hour));
}


/**
 * Tao chu khong dau & thay the dau cach bang dau -
 * @param  [type] $string     [description]
 * @param  string $keyReplace [description]
 * @return [type]             [description]
 */
function removeTitle($string, $keyReplace = "/"){
	$string = removeAccent($string);
	$string =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	$string =  str_replace(" ","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace("--","-",$string);
	$string = str_replace($keyReplace,"-",$string);
	return strtolower($string);
}

/**
 * Remove tieng viet thanh khong dau
 * @param  [type] $string [description]
 * @return [type]         [description]
 */
function removeAccent($string) {
	$marTViet = array(
	// Chữ thường
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ","Đ","'",
	// Chữ hoa
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ","Đ","'",
	);
	$marKoDau=array(
		/// Chữ thường
		"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d","D","",
		//Chữ hoa
		"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D","D","",
		);
	return str_replace($marTViet, $marKoDau, $string);
}


/**
 * Táº¡o link sort
 *
 * @param  url $url
 * @param  array  $sortArray
 * @example http://example.com => http://example.com?name=desc&age=asc
 *
 * @return url
 */
function createLinkSort($field, $url = null) {

	if(!isUrl($url)) {
		throw new \Exception("Url is not valid", 1);
	}

	$get      = $_GET;
	$parseUrl = parse_url($url);

	if(strpos($url, '?') !== false) {
		parse_str($parseUrl['query'], $urlParams);
	}

	if(isset($get[$field])) {
		if($get[$field] == 'asc') {
			$get[$field] = 'desc';
		} else {
			$get[$field] = 'asc';
		}
	} else {
		$get[$field] = 'desc';
	}

	$urlReturn = $parseUrl['scheme'] . '://' . $parseUrl['host'];
	$urlReturn .= '?' . http_build_query($get);

	return $urlReturn;
}

/**
 * Check URL
 *
 * @param  string  $url
 * @return boolean
 */
function isUrl($url) {
	return filter_var($url, FILTER_VALIDATE_URL);
}

if ( ! function_exists('str_remove_accent')) {
	/**
	 * @param $str
	 * @param string $separator
	 * @return mixed
	 */
	function str_remove_accent($str, $separator = ' ')
	{
		$str = trim($str);
		$str = stripslashes($str);
		$str = str_replace(array("&quot;", ":", ".", "'", ",", ";", ")", "(", "?", "@", "%", "*", "&", "^", "!", "=", "{", "}", "\\", '"', '-', 'â€˜', 'â€™', 'â€¢', "&nbsp;"), " ", $str);
		$str = preg_replace("/(Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ)/", 'a', $str);
		$str = preg_replace("/(Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»|áº¿|á»‡|á»ƒ|á»…)/", 'e', $str);
		$str = preg_replace("/(Ã¬|Ã­|á»‹|á»‰|Ä©)/", 'i', $str);
		$str = preg_replace("/(Ã²|Ã³|á»|á»|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡)/", 'o', $str);
		$str = preg_replace("/(Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯)/", 'u', $str);
		$str = preg_replace("/(á»³|Ã½|á»µ|á»·|á»¹)/", 'y', $str);
		$str = preg_replace("/(Ä‘)/", 'd', $str);
		$str = preg_replace("/(Ã€|Ã|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´)/", 'A', $str);
		$str = preg_replace("/(Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„)/", 'E', $str);
		$str = preg_replace("/(ÃŒ|Ã|á»Š|á»ˆ|Ä¨)/", 'I', $str);
		$str = preg_replace("/(Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» )/", 'O', $str);
		$str = preg_replace("/(Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®)/", 'U', $str);
		$str = preg_replace("/(á»²|Ã|á»´|á»¶|á»¸)/", 'Y', $str);
		$str = preg_replace("/(Ä)/", 'D', $str);
		$str = str_replace(array(' ', '--', '|', "/", '_', "[", "]", "+"), $separator, $str);
		$str = strtolower($str);
		return $str;
	}
}

if ( ! function_exists('str_slug_uft8')) {
	/**
	 * @param $title
	 * @param string $separator
	 * @return string
	 */
	function str_slug_uft8($title, $separator = '-')
	{
		$title = str_remove_accent($title);
		$flip = $separator == '-' ? '_' : '-';
		$title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);
		$title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($title));
		$title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

		return trim($title, $separator);
	}
}


/*
* $key - Field data need validate
* @return true|false
*/
function hasError($key) {
	$errors = Session::get('errors');
	if (count($errors) && $errors->has($key)) {
	  return true;
	}
	return false;
}
/*
* $key - Field data need validate
* @return Nếu có lỗi thì add class has-error, ngược lại
*/
function hasValidator($key) {
	$status = '';
	if (hasError($key)) {
	  $status = 'has-error';
	} elseif (Session::has('errors') && !hasError($key)) {
	  $status = 'has-success';
	}
	return $status;
}

function alertError($key) {
	$errors = Session::get('errors');
	if (hasError($key)) {
		return $errors->first($key, '<p class="help-inline text-danger text-left">:message</p>');
	}
	return '';
}

/**
 * Hàm format định dạng số
 * @param  number  $number
 * @return string
 */
function format_number($number, $sufix = ''){

	if(is_numeric($number)) {
	   $return  = number_format($number, 2, ".", ",");
	   if(intval(substr($return, -2, 2)) == 0) $return = number_format($number, 0, ".", ".");
	   elseif(intval(substr($return, -1, 1)) == 0) $return = number_format($number, 1, ".", ".");

	   if ($sufix == 'đ') {
	   	$return = $return . '<sup>' . $sufix . '</sup>';
	   }

	   return $return;
	}

	return null;
}

/**
 * Format currency
 *
 * @param  double|float|integer $number
 *
 * @return string
 */
function formatCurrency($number, $prefix = '', $sufix = '') {
	return $prefix . number_format($number, 0, '.', '.') . $sufix;
}

/**
 * Debug function
 */
function _debug($data) {

	echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
	echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';

	$debug_backtrace = debug_backtrace();
	$debug = array_shift($debug_backtrace);

	echo '<div>File: ' . $debug['file'] . '</div>';
	echo '<div>Line: ' . $debug['line'] . '</div>';

	if(is_array($data) || is_object($data)) {
		print_r($data);
	}
	else {
		var_dump($data);
	}
	echo '</pre>';
}

function pagination($items, $total, $perPage, $currentPage = null, $options = array(), $url = null) {
	$paginator =  new \Illuminate\Pagination\LengthAwarePaginator($items, $total, $perPage, $currentPage, $options);
	$paginator->setPath($url);
	$bootstrapPaginator = new \Illuminate\Pagination\BootstrapThreePresenter($paginator->appends($_GET));
	return '<div id="custom-pagination" class="custom-pagination">' . $bootstrapPaginator->render() . '</div>';
}

/**
 * Add params to url
 * @param  array  $params [key => value]
 * @return query string
 */
function url_add_params(array $params) {
	$array_url_params = array();

	foreach($_GET as  $key => $value) {
		$array_url_params[$key] = $value;
	}

	if(!empty($params)) {
		foreach($params as $k => $v) {
			$array_url_params[$k] = $v;
		}
	}

	$url_current = $_SERVER['REQUEST_URI'];

	if($pos = strpos($_SERVER['REQUEST_URI'], '?')) {
		$url_current = substr($_SERVER['REQUEST_URI'], 0, $pos);
	}

	return $url_current . '?' . urldecode(http_build_query($array_url_params));
}

function addConditionsFilter($array, $key, $value){
	if(empty($value)){
		if(isset($array[$key])){
			unset($array[$key]);
		}
		return $array;
	}

	$values = array($value);
	if(!empty($array[$key])){
		$olds = explode(':', $array[$key]);
		$values = in_array($value, $olds) ? array_diff($olds, $values) : array_merge($olds, $values);
	}
	$array[$key] = implode(':', $values);
	return $array;
}

function getUrlCompareProduct($productId, $url = null) {
	$params = addConditionsFilter($_GET, 'p', $productId);
	return url_add_params($params);
}

/**
 * In hoa chữ cái đầu tiên trong 1 chuỗi
 *
 * @param string $string
 *
 * @return string
 */
function firstLetterUpperCase($string) {
	$first = mb_substr($string, 0, 1);
	$sub = mb_substr($string, 1, mb_strlen($string));
	return mb_strtoupper($first) . $sub;
}


/**
 * Get html breadcrumb item
 *
 * @param  string  $name
 * @param  string  $url
 * @param  boolean $active
 * @return html
 */
function getBreadcrumbItem($name, $url, $active = false, $htmlAttributes = []) {
	$class_active = $active ? 'active' : 'normal';

	if($active) {
		$link_item = '<span itemprop="item"><span itemprop="name">'. strip_tags($name) .'</span></span>';
	}else {
		$link_item = '<a href="'. $url .'" itemprop="item">
				   	<span itemprop="name">'. strip_tags($name) .'</span>
						</a>';
	}

	$attributes = mergeAttributes(['class' => $class_active], $htmlAttributes);

	return '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" '. makeAttributes($attributes) .'>'. $link_item .'</li>';
}

/**
* Merge Attributes
*
* @return array attributes.
*/
function mergeAttributes() {

	$args = func_get_args();

	$temp_attributes = array();

	$attributes = array();

	foreach($args as $key => $array_attr) {
		foreach($array_attr as $name_attr => $value_attr) {
			if($name_attr == 'class') {
				$temp_attributes[$name_attr][] = $value_attr;
			}else{
				$temp_attributes[$name_attr] = $value_attr;
			}
		}
	}

	foreach($temp_attributes as $name_attr => $value_attr) {
		if($name_attr == 'class') {
			$attributes[$name_attr] = implode(' ', $value_attr);
		}else{
			$attributes[$name_attr] = $value_attr;
		}
	}

	return $attributes;
}

/**
 * Generate string attributes
 * @param  array $attributes
 * @return string
 */
function makeAttributes($attributes) {

	$stringAttribute = '';

	if(is_array($attributes)) {
		foreach($attributes as $key => $value) {
			$stringAttribute .= "$key=\"$value\" ";
		}
	}else{
		$stringAttribute = @strval($attributes);
	}

	return trim($stringAttribute, ' ');
}


function getServerName() {
	return Request::server('SERVER_NAME');
}


function getTagPositions() {
	return [
		\Nht\Hocs\Tags\Tag::POSITION_HEADER => 'Header',
		\Nht\Hocs\Tags\Tag::POSITION_FOOTER => 'Footer'
	];
}

function getPositionByKey($key) {
	if(array_key_exists($key, getTagPositions())) {
		return array_get(getTagPositions(), $key);
	}
}


function cutString($string, $length = 150, $ext = '...') {
	if(!$string) return $string;
	$str = mb_substr($string, 0, $length);
	if(mb_strlen($str) < $length) {
		return $string;
	}

	return $str . $ext;
}

/**
 * Get http code
 * @param  string $resourceUrl
 * @return int
 */
function getHttpCode($resourceUrl) {
	$ch = curl_init($resourceUrl);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_exec($ch);
	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $statusCode;
}

/**
 * Generate keywords
 * @param  str $string
 * @return str
 */
function generateKeywords($string) {
	$stringExplode = explode(' ', $string);
	$keyword = '';
	foreach($stringExplode as $k => $v) {
		if(isset($stringExplode[$k]) && isset($stringExplode[$k+1])) {
			$keyword .= $stringExplode[$k] . ' ' . $stringExplode[$k+1] . ',';
			unset($stringExplode[$k]);
			unset($stringExplode[$k+1]);
		}
	}

	$keyword = trim($keyword, ',');

	return $keyword;
}


function getExtension($file) {
	$file = str_replace('\\', '/', $file);
	$lastdot = strrpos($file, '.');
	return strtolower(substr($file, $lastdot + 1));
}

function isLocalhost() {
	return @$_SERVER['REMOTE_ADDR'] == '127.0.0.1';
}

function getStrDayOfWeek($day) {
	switch ($day) {
		case 0:
			return 'Thứ hai';

		case 1:
			return 'Thứ ba';

		case 2:
			return 'Thứ tư';

		case 3:
			return 'Thứ năm';

		case 4:
			return 'Thứ sáu';

		case 6:
			return 'Thứ bảy';

		case 7:
			return 'Chủ nhật';

		default:
			return 'Không phải ngày trong tuần';
	}
}


function sanitize_output($buffer) {

    $search = array(
	'/\>[^\S ]+/s',
	'/[^\S ]+\</s',
	'/(\s)+/s'
	);

	$replace = array(
	'>',
	'<',
	'\\1'
	);

	if (preg_match("/\<html/i",$buffer) == 1 && preg_match("/\<\/html\>/i",$buffer) == 1) {
		$buffer = preg_replace($search, $replace, $buffer);
	}

	return $buffer;
}

if ( !function_exists('change_date') ) {
	function change_date($date) {
		$date = $date . date("H:i:s");
        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d H:i:s', strtotime($date));
        return $date;
	}
}

if ( !function_exists('position_ads')) {
	function position_ads() {
		return [
			TOP_PAGE => 'Đầu trang',
			CENTER_PAGE_1 => 'Thân trang 1',
			CENTER_PAGE_2 => 'Thân trang 2',
			END_PAGE => 'Cuối trang'
		];
	}
}


if ( !function_exists('getRealIp') ) {
	function getRealIp() {
		return $_SERVER['HTTP_X_REAL_IP'];
	}
}