<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private EventDispatcherInterface $eventDispatcher; 


    public function __construct(EmailVerifier $emailVerifier, EventDispatcherInterface $eventDispatcher)
    {
        $this->emailVerifier = $emailVerifier;
        $this->eventDispatcher = $eventDispatcher; 
    }




    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Verificar si el correo contiene "@seo.org" y asignar el rol "ROLE_ADMIN" si es así
            $email = $user->getEmail();
            if (strpos($email, '@cun.edu.co') !== false) {
                $user->addRole("ROLE_ADMIN");
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // automatic login
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->eventDispatcher->dispatch($event);

             $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('francoarazualexsandro@gmail.com', 'REGISTRO API SEO BIRD LIFE'))
                    ->to($user->getEmail())
                    ->subject('ESTO ES UNA CONFIRMACIÓN DE TU CUENTA')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            if (in_array("ROLE_ADMIN", $user->getRoles())) {
                return $this->redirectToRoute('app_client_home'); 
            } else {
                return $this->redirectToRoute('app_user_home'); 
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Tu dirección de correo electrónico ha sido verificada.');

        return $this->redirectToRoute('app_register');
    }
}
