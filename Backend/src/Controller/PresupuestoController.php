<?php

namespace App\Controller;

use App\Entity\Presupuesto;
use App\Form\PresupuestoType;
use App\Repository\PresupuestoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/presupuesto')]
class PresupuestoController extends AbstractController
{
    #[Route('/', name: 'app_presupuesto_index', methods: ['GET'])]
    public function index(PresupuestoRepository $presupuestoRepository): Response
    {
        return $this->render('presupuesto/index.html.twig', [
            'presupuestos' => $presupuestoRepository->findAll(),
        ]);
    }
      //api
      #[Route('/apis', name: 'app_presupuesto_apis', methods: ['GET'])]
      public function apis(PresupuestoRepository $presupuestoRepository,SerializerInterface $serializer): Response
      {
          $entityManager = $this -> getDoctrine()->getManager();
          $presupuesto=$entityManager->getRepository(Presupuesto::class)-> findall();
  
          
  
          $json = $serializer->serialize(  $presupuesto,"json");
          return new Response($json,Response::HTTP_OK,['Content-type' => 'application/json']);
          
      }

    #[Route('/new', name: 'app_presupuesto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $presupuesto = new Presupuesto();
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($presupuesto);
            $entityManager->flush();

            return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presupuesto/new.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presupuesto_show', methods: ['GET'])]
    public function show(Presupuesto $presupuesto): Response
    {
        return $this->render('presupuesto/show.html.twig', [
            'presupuesto' => $presupuesto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presupuesto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presupuesto $presupuesto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presupuesto/edit.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presupuesto_delete', methods: ['POST'])]
    public function delete(Request $request, Presupuesto $presupuesto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presupuesto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($presupuesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }
}
