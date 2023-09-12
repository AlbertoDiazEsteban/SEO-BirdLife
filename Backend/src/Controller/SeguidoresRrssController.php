<?php

namespace App\Controller;

use App\Entity\SeguidoresRrss;
use App\Form\SeguidoresRrssType;
use App\Repository\SeguidoresRrssRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
 
#[Route('/seguidores/rrss')]
class SeguidoresRrssController extends AbstractController
{
    #[Route('/', name: 'app_seguidores_rrss_index', methods: ['GET'])]
    public function index(SeguidoresRrssRepository $seguidoresRrssRepository): Response
    {
        return $this->render('seguidores_rrss/index.html.twig', [
            'seguidores_rrsses' => $seguidoresRrssRepository->findAll(),
        ]);
    }

       //api
       #[Route('/apis', name: 'app_seguidores/rrss_apis', methods: ['GET'])]
       public function apis(SeguidoresRrssRepository $seguidoresRrssRepository,SerializerInterface $serializer): Response
       {
           $entityManager = $this -> getDoctrine()->getManager();
           $seguidoresRrss=$entityManager->getRepository(SeguidoresRrss::class)-> findall();
   
           
   
           $json = $serializer->serialize(  $seguidoresRrss,"json");
           return new Response($json,Response::HTTP_OK,['Content-type' => 'application/json']);
           
       }
    
   

    #[Route('/new', name: 'app_seguidores_rrss_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seguidoresRrss = new SeguidoresRrss();
        $form = $this->createForm(SeguidoresRrssType::class, $seguidoresRrss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seguidoresRrss);
            $entityManager->flush();

            return $this->redirectToRoute('app_seguidores_rrss_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seguidores_rrss/new.html.twig', [
            'seguidores_rrss' => $seguidoresRrss,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seguidores_rrss_show', methods: ['GET'])]
    public function show(SeguidoresRrss $seguidoresRrss): Response
    {
        return $this->render('seguidores_rrss/show.html.twig', [
            'seguidores_rrss' => $seguidoresRrss,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seguidores_rrss_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SeguidoresRrss $seguidoresRrss, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeguidoresRrssType::class, $seguidoresRrss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seguidores_rrss_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seguidores_rrss/edit.html.twig', [
            'seguidores_rrss' => $seguidoresRrss,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seguidores_rrss_delete', methods: ['POST'])]
    public function delete(Request $request, SeguidoresRrss $seguidoresRrss, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seguidoresRrss->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seguidoresRrss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seguidores_rrss_index', [], Response::HTTP_SEE_OTHER);
    }
}
