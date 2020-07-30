<?php


namespace App\Tests\Util\EntityTest;


use App\Entity\Image;
use Monolog\Test\TestCase;

class ImageTest extends TestCase
{

    public function testSrc()
    {
        $image = new Image();
        $src = "test.png";

        $image->setSource($src);
        $this->assertEquals("test.png", $image->getSource());
    }

    public function testAlt()
    {
        $image = new Image();
        $alt = "altTest.jpg";

        $image->setAlternatif($alt);
        $this->assertEquals("altTest.jpg", $image->getAlternatif());
    }

}