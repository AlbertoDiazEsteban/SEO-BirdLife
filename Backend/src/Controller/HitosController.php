<?php

namespace App\Controller;

use App\Entity\Hitos;
use App\Form\HitosType;
use App\Repository\HitosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hitos')]
class HitosController extends AbstractController
{
    #[Route('/', name: 'app_hitos_index', methods: ['GET'])]
    public function index(HitosRepository $hitosRepository): Response
    {
        return $this->render('hitos/index.html.twig', [
            'hitos' => $hitosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hitos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hito = new Hitos();
        $form = $this->createForm(HitosType::class, $hito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hito);
            $entityManager->flush();

            return $this->redirectToRoute('app_hitos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hitos/new.html.twig', [
            'hito' => $hito,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hitos_show', methods: ['GET'])]
    public function show(Hitos $hito): Response
    {
        return $this->render('hitos/show.html.twig', [
            'hito' => $hito,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hitos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hitos $hito, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HitosType::class, $hito);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hitos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hitos/edit.html.twig', [
            'hito' => $hito,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hitos_delete', methods: ['POST'])]
    public function delete(Request $request, Hitos $hito, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hito->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hito);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hitos_index', [], Response::HTTP_SEE_OTHER);
    }
}
