<?php


namespace App\Tests\Util\EntityTest;


use App\Entity\Video;
use Monolog\Test\TestCase;

class VideoTest extends TestCase
{

    public function testSrc()
    {
        $video = new Video();
        $src = "youtube/embed/vds";

        $video->setSource($src);
        $this->assertEquals("youtube/embed/vds", $video->getSource());
    }

}