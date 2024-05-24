<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SymfonyExample extends AbstractController
{
    public function index($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            )

            // you can remove the following code if you don't define a text version for your emails
            ->addPart(
                $this->renderView(
                // templates/emails/registration.txt.twig
                    'emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
        ;

        $mailer->send($message);

        return $this->render(...);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SymfonyExample extends AbstractController
{
    public function index($name, \Swift_Mailer $mailer)
    {
        $message = ((new \Symfony\Component\Mime\Email())->subject('Hello Email'))
            ->from(new \Symfony\Component\Mime\Address('send@example.com'))
            ->to(new \Symfony\Component\Mime\Address('recipient@example.com'))
            ->html(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => $name]
                )
            )

            // you can remove the following code if you don't define a text version for your emails
            ->addPart(
                $this->renderView(
                // templates/emails/registration.txt.twig
                    'emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
        ;

        $mailer->send($message);

        return $this->render(...);
    }
}

?>
