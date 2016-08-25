<?php namespace Nht\Hocs\Core\Images;

use Nht\Hocs\Core\Uploads\Upload;

class ImageFactory {

	protected $upload;

	protected $image;

	public function __construct(Upload $upload, Image $image) {
		$this->upload = $upload;
		$this->image  = $image;
	}

	public function upload($fileControl, $pathUpload, $arrayThumbs, $optional = 'resize') {
		$return = [
			'status'   => 0,
			'thumbs'   => [],
			'filename' => '',
			'size'     => 0,
			'path'     => ''
		];

		if($fileName = $this->upload->upload($fileControl, $pathUpload)) {
			$thumbs = [];

			if($optional == 'resize') {
				$thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
			} else if ($optional == 'crop') {
				$thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
			}

			$return['status']   = 1;
			$return['thumbs']   = $thumbs;
			$return['filename'] = $fileName;
			$return['path']     = $pathUpload . $fileName;
			$return['size']     = filesize($pathUpload . $fileName);
		}

		return $return;
	}


	public function download($url, $pathUpload, $arrayThumbs = array(), $optional = 'resize') {
		$return = [
			'status'   => 0,
			'thumbs'   => [],
			'filename' => '',
			'size'     => 0,
			'path'     => ''
		];

		$dataImage = file_get_contents($url);
		$fileName  = sha1($url) . '.jpg';

		if(file_put_contents($pathUpload . $fileName, $dataImage)) {
			$thumbs = [];

			if($optional == 'resize') {
				$thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
			} else if ($optional == 'crop') {
				$thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
			}

			$return['status']   = 1;
			$return['thumbs']   = $thumbs;
			$return['filename'] = $fileName;
			$return['path']     = $pathUpload . $fileName;
			$return['size']     = filesize($pathUpload . $fileName);
		}

		return $return;
	}
}