<?php

namespace App\Services;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoService extends AbstractController
{
    public function addVideo($trick, $entityManager){
        foreach ($trick->getVideo() as $video)
        {
            $entityManager->persist($video);
        }

    }
}