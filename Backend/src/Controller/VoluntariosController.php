<?php

namespace App\Controller;

use App\Entity\Voluntarios;
use App\Form\VoluntariosType;
use App\Repository\VoluntariosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/voluntarios')]
class VoluntariosController extends AbstractController
{
    #[Route('/', name: 'app_voluntarios_index', methods: ['GET'])]
    public function index(VoluntariosRepository $voluntariosRepository): Response
    {
        return $this->render('voluntarios/index.html.twig', [
            'voluntarios' => $voluntariosRepository->findAll(),
        ]);
    }
// api
    #[Route('/apis', name: 'app_voluntarios_apis', methods: ['GET'])]
    public function apis(VoluntariosRepository $voluntariosRepository,SerializerInterface $serializer): Response
    {
        $entityManager = $this -> getDoctrine()->getManager();
        $voluntarios=$entityManager->getRepository(voluntarios::class)-> findall();

        //dump($skills); die;

        $json = $serializer->serialize($voluntarios,"json");
        return new Response($json,Response::HTTP_OK,['Content-type' => 'application/json']);
        
    }

    
    #[Route('/new', name: 'app_voluntarios_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voluntario = new Voluntarios();
        $form = $this->createForm(VoluntariosType::class, $voluntario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voluntario);
            $entityManager->flush();

            return $this->redirectToRoute('app_voluntarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voluntarios/new.html.twig', [
            'voluntario' => $voluntario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voluntarios_show', methods: ['GET'])]
    public function show(Voluntarios $voluntario): Response
    {
        return $this->render('voluntarios/show.html.twig', [
            'voluntario' => $voluntario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voluntarios_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voluntarios $voluntario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoluntariosType::class, $voluntario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voluntarios_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voluntarios/edit.html.twig', [
            'voluntario' => $voluntario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voluntarios_delete', methods: ['POST'])]
    public function delete(Request $request, Voluntarios $voluntario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voluntario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voluntario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voluntarios_index', [], Response::HTTP_SEE_OTHER);
    }
}
