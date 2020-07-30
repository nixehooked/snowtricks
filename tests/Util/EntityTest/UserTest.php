<?php


namespace App\Tests\Util\EntityTest;


use App\Entity\User;
use Monolog\Test\TestCase;

class UserTest extends TestCase
{

    public function testEmail()
    {
        $user = new User();
        $email = "test@gmail.test";

        $user->setEmail($email);
        $this->assertEquals("test@gmail.test", $user->getEmail());
    }

    public function testPw()
    {
        $user = new User();
        $pw = "testpw";

        $user->setPassword($pw);
        $this->assertEquals("testpw", $user->getPassword());
    }

    public function testSurname()
    {
        $user = new User();
        $surname = "test";

        $user->setSurname($surname);
        $this->assertEquals("test", $user->getSurname());
    }

    public function testName()
    {
        $user = new User();
        $name = "Paul";

        $user->setName($name);
        $this->assertEquals("Paul", $user->getName());
    }

}