<?php

namespace App\Controller;

use App\Entity\Proyects;
use App\Form\ProyectsType;
use App\Repository\ProyectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/proyects')]
class ProyectsController extends AbstractController
{
    #[Route('/', name: 'app_proyects_index', methods: ['GET'])]
    public function index(ProyectsRepository $proyectsRepository): Response
    {
        return $this->render('proyects/index.html.twig', [
            'proyects' => $proyectsRepository->findAll(),
        ]);
    }

     //convertir json y envio  de  informacion api
     #[Route('/apis', name: 'app_proyects_apis', methods: ['GET'])]
     public function apis(ProyectsRepository $proyectsRepository,SerializerInterface $serializer): Response
     {
         $entityManager = $this -> getDoctrine()->getManager();
         $proyects=$entityManager->getRepository( proyects::class)-> findall();
 
         //dump($skills); die;
 
         $json = $serializer->serialize($proyects,"json");
         return new Response($json,Response::HTTP_OK,['Content-type' => 'application/json']);
         
     }

    #[Route('/new', name: 'app_proyects_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProyectsRepository $proyectsRepository): Response
    {
        $proyect = new Proyects();
        $form = $this->createForm(ProyectsType::class, $proyect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proyectsRepository->save($proyect, true);

            return $this->redirectToRoute('app_proyects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyects/new.html.twig', [
            'proyect' => $proyect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proyects_show', methods: ['GET'])]
    public function show(Proyects $proyect): Response
    {
        return $this->render('proyects/show.html.twig', [
            'proyect' => $proyect,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_proyects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Proyects $proyect, ProyectsRepository $proyectsRepository): Response
    {
        $form = $this->createForm(ProyectsType::class, $proyect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proyectsRepository->save($proyect, true);

            return $this->redirectToRoute('app_proyects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyects/edit.html.twig', [
            'proyect' => $proyect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proyects_delete', methods: ['POST'])]
    public function delete(Request $request, Proyects $proyect, ProyectsRepository $proyectsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proyect->getId(), $request->request->get('_token'))) {
            $proyectsRepository->remove($proyect, true);
        }

        return $this->redirectToRoute('app_proyects_index', [], Response::HTTP_SEE_OTHER);
    }
}
