<?php


namespace App\Tests\Util\EntityTest;


use App\Entity\Group;
use Monolog\Test\TestCase;

class GroupsTest extends TestCase
{

    public function testName()
    {
        $group = new Group();
        $name = "Max";

        $group->setName($name);
        $this->assertEquals("Max", $group->getName());
    }

    public function testDesc()
    {
        $group = new Group();
        $desc = "Test de la description";

        $group->setDescription($desc);
        $this->assertEquals("Test de la description", $group->getDescription());
    }

}