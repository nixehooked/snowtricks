<?php


namespace App\Tests\Util;


use App\Controller\Member\TrickController;
use App\Entity\Trick;
use Monolog\Test\TestCase;

class TrickTest extends TestCase
{

    public function testAdd()
    {
        $trick = new TrickController();
        $result = $trick->new(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }

    public function testShow()
    {

        $trick = new TrickController();
        $result = $trick->show(30, 12);

        $this->assertEquals(42, $result);

    }

}