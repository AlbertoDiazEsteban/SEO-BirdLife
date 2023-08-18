<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class RegisterApiController extends AbstractController
{
    #[Route('/registration', name: 'app_register_api', methods:'GET')]



    public function registration(Request $request, UserPasswordHasherInterface 
    $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {


        $user = new User();
        //$em = $this->getDoctrine()->getManager();
        $response = new Response();

        if($request->query->get('mail')) {
            $emailnew = $request->query->get('mail');
            $passwordnew = $request->query->get('password');
            
            $user->setEmail($emailnew);
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword( 
                $userPasswordHasher->hashPassword(
                    $user,$passwordnew
                ));


            $entityManager->persist($user);
            $entityManager->flush();
            
            $response->setContent(json_encode([
                'registro' => "valido ".$emailnew,
                'password' => "valido ".$passwordnew
            ]));
        }

       
     
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('pass', 'ok');
        
  
        
        return $response; 
    }

}
