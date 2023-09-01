<?php

namespace App\Controller;

use App\Entity\Socios;
use App\Form\SociosType;
use App\Repository\SociosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/socios')]
class SociosController extends AbstractController
{
    #[Route('/', name: 'app_socios_index', methods: ['GET'])]
    public function index(SociosRepository $sociosRepository): Response
    {
        return $this->render('socios/index.html.twig', [
            'socios' => $sociosRepository->findAll(),
        ]);
    }

     //api
    #[Route('/apis', name: 'app_socios_apis', methods: ['GET'])]
    public function apis(SociosRepository $sociosRepository,SerializerInterface $serializer): Response
    {
        $entityManager = $this -> getDoctrine()->getManager();
        $socios=$entityManager->getRepository(socios::class)-> findall();

        

        $json = $serializer->serialize( $socios,"json");
        return new Response($json,Response::HTTP_OK,['Content-type' => 'application/json']);
        
    }
 

    #[Route('/new', name: 'app_socios_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $socio = new Socios();
        $form = $this->createForm(SociosType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($socio);
            $entityManager->flush();

            return $this->redirectToRoute('app_socios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('socios/new.html.twig', [
            'socio' => $socio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_socios_show', methods: ['GET'])]
    public function show(Socios $socio): Response
    {
        return $this->render('socios/show.html.twig', [
            'socio' => $socio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_socios_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Socios $socio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SociosType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_socios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('socios/edit.html.twig', [
            'socio' => $socio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_socios_delete', methods: ['POST'])]
    public function delete(Request $request, Socios $socio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$socio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($socio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_socios_index', [], Response::HTTP_SEE_OTHER);
    }
}
