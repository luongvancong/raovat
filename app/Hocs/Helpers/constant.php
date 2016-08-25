<?php

// Base path
define('BASE_PATH', realpath(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/..') . '/');

$googleCloudStorage = 'http://static.giaca.org/';
// define('PATH_STATIC', $googleCloudStorage);

define('PATH_STATIC', $googleCloudStorage);

// Path assets
define('PATH_ASSETS', '/assets/');


// Path upload logo settings
define('LOGO_SETTING_PATH_UPLOAD', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/settings/');
define('LOGO_SETTING', PATH_STATIC . 'uploads/settings/');

// Path upload user avatar
define('PATH_UPLOAD_USER_AVATAR', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/users/');
define('PATH_USER_AVATAR', PATH_STATIC . 'uploads/users/');

// Banner
define('PATH_UPLOAD_BANNER', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/banners/');
define('PATH_BANNER', PATH_STATIC . 'uploads/banners/');

define('PATH_UPLOAD', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/');


define('PATH_UPLOAD_IMAGE_POST', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/posts/');
define('PATH_IMAGE_POST', PATH_STATIC . 'uploads/posts/');

define('PATH_UPLOAD_IMAGE_SITE', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/sites/');
define('PATH_IMAGE_SITE', PATH_STATIC . 'uploads/sites/');

// Upload image product
define('PATH_UPLOAD_IMAGE_PRODUCT', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/products/');
define('PATH_IMAGE_PRODUCT', PATH_STATIC . 'uploads/products/');

// Upload image advertise
define('PATH_UPLOAD_IMAGE_ADVERTISE', rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/uploads/advertise/');
define('PATH_IMAGE_ADVERTISE', PATH_STATIC . 'uploads/advertise/');

// Position Advertise
define('TOP_PAGE', 1);
define('CENTER_PAGE_1', 2);
define('CENTER_PAGE_2', 3);
define('END_PAGE', 4);
// define('POSITION_ADS', [
// 	TOP_PAGE => 'Đầu trang',
// 	CENTER_PAGE_1 => 'Thân trang 1',
// 	CENTER_PAGE_2 => 'Thân trang 2',
// 	END_PAGE => 'Cuối trang'
// ]);
