<?php

class ImageFactoryTest extends TestCase {
    public function test_downloadImage() {
        $image = App::make('ImageFactory');
        $url = 'https://graph.facebook.com/v2.5/1137364829648432/picture?type=normal';

        $pathUpload = '/home/justin/public_html/sat8web/public/uploads/users/';

        $config = Config::get('image');
        $thumbs = $config['array_crop_image'];
        $this->assertInternalType('array', $image->download($url, $pathUpload, $thumbs, 'crop'));
    }
}