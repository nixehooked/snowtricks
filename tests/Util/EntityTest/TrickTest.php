<?php


namespace App\Tests\Util;


use App\Controller\Member\TrickController;
use App\Entity\Trick;
use Monolog\Test\TestCase;

class TrickTest extends TestCase
{

    public function testName()
    {
        $trick = new Trick();
        $name = "Max";

        $trick->setName($name);
        $this->assertEquals("Max", $trick->getName());
    }

    public function testDesc()
    {
        $trick = new Trick();
        $desc = "Ceci est un test";

        $trick->setDescription($desc);
        $this->assertEquals("Ceci est un test", $trick->getDescription());
    }

    public function testUser()
    {
        $trick = new Trick();
        $user = $trick->getUser();

        $trick->setUser($user);
        $this->assertEquals($trick->getUser(), $trick->getUser());
    }

    public function testGroupe()
    {
        $trick = new Trick();
        $group = $trick->getGroups();

        $trick->setGroups($group);
        $this->assertEquals($trick->getGroups(), $trick->getGroups());
    }

    public function testSlug()
    {
        $trick = new Trick();
        $slug = "test slug";

        $trick->setSlug($slug);
        $this->assertEquals("test slug", $trick->getSlug());
    }
}