<?php

namespace App\Controller;

use App\Entity\Years;
use App\Form\YearsType;
use App\Repository\YearsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/years')]
class YearsController extends AbstractController
{
    #[Route('/', name: 'app_years_index', methods: ['GET'])]
    public function index(YearsRepository $yearsRepository): Response
    {
        return $this->render('years/index.html.twig', [
            'years' => $yearsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_years_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $year = new Years();
        $form = $this->createForm(YearsType::class, $year);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($year);
            $entityManager->flush();

            return $this->redirectToRoute('app_years_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('years/new.html.twig', [
            'year' => $year,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_years_show', methods: ['GET'])]
    public function show(Years $year): Response
    {
        return $this->render('years/show.html.twig', [
            'year' => $year,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_years_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Years $year, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(YearsType::class, $year);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_years_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('years/edit.html.twig', [
            'year' => $year,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_years_delete', methods: ['POST'])]
    public function delete(Request $request, Years $year, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$year->getId(), $request->request->get('_token'))) {
            $entityManager->remove($year);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_years_index', [], Response::HTTP_SEE_OTHER);
    }
}
