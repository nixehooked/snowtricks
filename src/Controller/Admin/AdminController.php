<?php

namespace App\Controller\Admin;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("admin/tricks", name="admin_trick_index", methods={"GET"})
     */
    public function getAlltrick(TrickRepository $trickRepository): Response
    {
        return $this->render('Admin/tricks.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }
}
