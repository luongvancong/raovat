<?php

class FunctionTest extends TestCase {

    public function test_GenerateKeywords() {
        $string = 'a b c d e f g h';
        $res = 'a b,c d,e f,g h';
        $this->assertEquals(generateKeywords($string), $res);
    }

    public function test_getExtension() {
        $file = 'http://google.com/example.jpg';
        $res = 'jpg';
        $this->assertEquals(getExtension($file), $res);
    }



}