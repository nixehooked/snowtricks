<?php

namespace App\Controller\Admin;

use App\Entity\User;
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
        return $this->render('Admin/index.html.twig');
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
    /**
     * @Route("admin/user/promote/{id}", name="promote_admin", methods={"GET"})
     */
    public function promoteadmin(User $user): Response
    {
        $user->setRoles(['roles' => 'ROLE_ADMIN']);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('admin_user_index');
    }
}
