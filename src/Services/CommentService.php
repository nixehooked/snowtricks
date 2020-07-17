<?php

namespace App\Services;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommentService extends AbstractController
{
    public function addComment($trick, $comment){

        $user=$this->getUser();
        $comment->setTrick($trick)->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();

        return $comment;

    }


}