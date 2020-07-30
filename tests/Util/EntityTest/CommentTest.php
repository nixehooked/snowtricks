<?php


namespace App\Tests\Util\EntityTest;


use App\Entity\Comment;
use Monolog\Test\TestCase;

class CommentTest extends TestCase
{

    public function test()
    {
        $comment = new Comment();
        $content = "Lorem ipsum";

        $comment->setContent($content);
        $this->assertEquals("Lorem ipsum", $comment->getContent());
    }

    public function testUser()
    {
        $comment = new Comment();
        $user = $comment->getUser();

        $comment->setUser($user);
        $this->assertEquals($comment->getUser(), $comment->getUser());
    }

}