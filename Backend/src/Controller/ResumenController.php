<?php

namespace App\Controller;

use App\Entity\Resumen;
use App\Form\ResumenType;
use App\Repository\ResumenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/resumen')]
class ResumenController extends AbstractController
{
    #[Route('/', name: 'app_resumen_index', methods: ['GET'])]
    public function index(ResumenRepository $resumenRepository): Response
    {
        return $this->render('resumen/index.html.twig', [
            'resumens' => $resumenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resumen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $resuman = new Resumen();
        $form = $this->createForm(ResumenType::class, $resuman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($resuman);
            $entityManager->flush();

            return $this->redirectToRoute('app_resumen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resumen/new.html.twig', [
            'resuman' => $resuman,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resumen_show', methods: ['GET'])]
    public function show(Resumen $resuman): Response
    {
        return $this->render('resumen/show.html.twig', [
            'resuman' => $resuman,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_resumen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resumen $resuman, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResumenType::class, $resuman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_resumen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resumen/edit.html.twig', [
            'resuman' => $resuman,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resumen_delete', methods: ['POST'])]
    public function delete(Request $request, Resumen $resuman, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resuman->getId(), $request->request->get('_token'))) {
            $entityManager->remove($resuman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_resumen_index', [], Response::HTTP_SEE_OTHER);
    }
}
