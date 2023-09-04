<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserHomeController extends AbstractController
{
    #[Route('/user/home', name: 'app_user_home')]
    public function index(): Response
    {
        return $this->render('user_home/index.html.twig', [
            'controller_name' => 'UserHomeController',
        ]);
    }
}
