<?php

namespace App\Tests;

use App\Controller\RegistrationController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Mailer\Test\Interception\AbstractEmailInterception;
use Symfony\Component\Mailer\Test\Interception\EmailInterception;
use Symfony\Component\Panther\PantherTestCase;

class RegistrationControllerTest extends PantherTestCase
{
    public function testEmailIsSentAfterRegistration(): void
    {
        $client = static::createPantherClient();

        // Interceptamos el envío de correo electrónico para su posterior verificación
        AbstractEmailInterception::setEnabled(true);
        AbstractEmailInterception::intercept();

        // Simulamos una solicitud POST a la página de registro con datos válidos
        $client->request('POST', '/register', [
            'registration_form' => [
                'username' => 'testuser',
                'email' => 'testuser@example.com',
                'plainPassword' => 'password',
            ],
        ]);

        // Verificamos que la respuesta sea una redirección (por ejemplo, a la página de inicio)
        $this->assertResponseRedirects('/');

        // Obtenemos todos los correos electrónicos que se enviaron durante la solicitud
        $emails = EmailInterception::getSentEmails();

        // Verificamos si se envió un correo electrónico
        $this->assertCount(1, $emails);

        // Verificamos el contenido del correo electrónico
        $email = $emails[0];
        $this->assertSame('francoarazualexsandro@gmail.com', $email->getFrom()[0]->getAddress());
        $this->assertSame('testuser@example.com', $email->getTo()[0]->getAddress());
        $this->assertSame('ESTO ES UNA CONFIRMACION DE TU CUENTA', $email->getSubject());
        $this->assertStringContainsString('contenido esperado', $email->getTextBody());
    }

    public function testFailedRegistrationWithInvalidData(): void
    {
        $client = static::createPantherClient();

        // Simulamos una solicitud POST a la página de registro con datos inválidos o faltantes
        $client->request('POST', '/register', [
            'registration_form' => [
                // Datos de registro inválidos o faltantes
            ],
        ]);

        // Verificamos que la respuesta sea un código de estado 200 (OK)
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Verificamos que se muestra un mensaje de error en la página
        $this->assertSelectorTextContains('div.alert-danger', 'Error en el registro');
    }
}
