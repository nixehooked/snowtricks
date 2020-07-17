<?php

namespace App\Controller\Member;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use App\Services\ImageService;
use App\Services\VideoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/")
 */
class TrickController extends AbstractController
{
    public function __construct()
    {
        $isAdmin=false;
    }

    /**
     * @Route("/", name="trick_index", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('Member/home/index.html.twig', [
            'tricks' => $trickRepository->getVisibleTrick(),
        ]);
    }

    /**
     * @Route("trick/new", name="trick_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     *
     */
    public function new(Request $request, ImageService $imageService, VideoService $videoService): Response
    {
        $trick = new Trick();
        $user=$this->getUser();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $files=$form->get('image')->getData();

            foreach ($files as $image){
               $trick->addImage($imageService->upload($trick, $image));
            }
            $videoService->addVideo($trick, $entityManager);
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
    public function show($id, Request $request, TrickRepository $trickRepository): Response
    {
        $trick= $trickRepository->getTrickById($id);
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $user=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTrick($trick)->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('trick_show', ['id'=>$trick->getId()]);
        }
        return $this->render('Member/trick/show.html.twig', [
            'trick' =>$trick,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("trick/{id}/edit", name="trick_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Trick $trick, ImageService $imageService, VideoService $videoService): Response
    {
        $user=$this->getUser();

        foreach ($user->getRoles() as $role){
            if ($role=='ROLE_ADMIN'){
                $isAdmin=true;
            }
        }

        if($this->getUser()!=$trick->getUser() AND !$isAdmin) {
            throw $this->createNotFoundException('Vous ne pouvez pas modifier ce trick');
        }
        else{
            $form = $this->createForm(TrickType::class, $trick);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $files=$form->get('image')->getData();
                foreach ($files as $image){
                    $trick->addImage($imageService->upload($trick, $image));
                }
                $videoService->addVideo($trick, $entityManager);
                $entityManager->persist($trick);
                $entityManager->flush();
                return $this->redirectToRoute('trick_index');

            }

            return $this->render('Member/trick/edit.html.twig', [
                'trick' => $trick,
                'form' => $form->createView(),
            ]);
        }

    }

    /**
     * @Route("trick/{id}", name="trick_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Trick $trick): Response
    {
        if($this->getUser()!=$trick->getUser()) {
            throw $this->createNotFoundException('Vous ne pouvez pas modifier ce trick');
        }
        else if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($trick);
                $entityManager->flush();
            return $this->redirectToRoute('trick_index');
        }

    }
    /**
     * @Route("image/{id}/delete", name="imaage_delete")
     * @IsGranted("ROLE_USER")
     */
    public function deleteImage(Request $request, Image $image): Response
    {
        $data=json_decode($request->getContent(), true);
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])) {
            $nom=$image->getSource();
            unlink($this->getParameter('images_directory').'/'.$nom);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
            return new JsonResponse(['success'=>1]);
        }else{
            return new JsonResponse(['error'=>'Token invalid'],400);
        }

        return $this->redirectToRoute('trick_index');
    }
}
