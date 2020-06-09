<?php

namespace App\Controller\Member;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use App\Services\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class TrickController extends AbstractController
{
    /**
     * @Route("/", name="trick_index", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('Member/home/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }

    /**
     * @Route("trick/new", name="trick_new", methods={"GET","POST"})
     */
    public function new(Request $request, ImageService $imageService): Response
    {
        $trick = new Trick();
        $user=$this->getUser();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($trick->getImage() as $image)
            {
                $imageService->upload($trick, $image);
            }
            foreach ($trick->getVideo() as $video)
            {
                $entityManager->persist($video);
            }
            $trick->setUser($user);
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('trick_index');
        }

        return $this->render('Member/trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("trick/{id}", name="trick_show", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function show(Trick $trick, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick)->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        return $this->render('Member/trick/show.html.twig', [
            'trick' => $trick,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trick_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trick $trick): Response
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trick_index');
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("trick/{id}", name="trick_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trick $trick): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trick_index');
    }
}
