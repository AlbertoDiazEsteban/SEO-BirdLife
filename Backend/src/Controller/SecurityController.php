<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Security $security): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        //dump($this->getUser());die;
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
  //dump($error);die;

        // Check if the user is authenticated
        // if ($this->getUser()) {
        //     // Check the user's roles
        //     if (in_array('ROLE_ADMIN', $security->getUser()->getRoles())) {
        //         // Redirect the admin user to a different route
        //         return $this->redirectToRoute('app_client_home'); 
        //     }
        //     else {
        //         // Redirect other users to a different route
        //         return $this->redirectToRoute('app_user_home'); // Cambia 'user_dashboard_route' al nombre de la ruta que deseas para los usuarios normales
        //     }
        // }

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
