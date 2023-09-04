<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterPageIsSuccessful(): void
    {
        $client = static::createClient();

        $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
    }

    public function testRegistrationFormSubmission(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        $form['registration_form[username]'] = 'testuser';
        $form['registration_form[email]'] = 'testuser@example.com';
        $form['registration_form[plainPassword]'] = 'password';

        $client->submit($form);

        $this->assertResponseRedirects('/'); 
    }

    public function testRegistrationWithInvalidData(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        
        $client->submit($form);

        $this->assertResponseIsSuccessful(); 
        $this->assertSelectorTextContains('div.alert-danger', 'Error en el registro');
    }

    public function testEmailConfirmationAfterRegistration(): void
    {
   

        $client = static::createClient();

      
    }
}
