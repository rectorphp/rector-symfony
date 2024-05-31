<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MailController extends AbstractController
{

    public function createMessage(string $name): \Swift_Message
    {
        return (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com', 'Sender')
            ->setPriority(2)
            ->setTo(['recipient@example.com' => 'Recipient', 'recipient2@example.com'])
            ->setCc(['cc@example.com' => 'CC'])
            ->addCc('cc2@example.com')
            ->setBody($this->renderView('emails/registration.html.twig', ['name' => $name]), 'text/html');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MailController extends AbstractController
{

    public function createMessage(string $name): \Symfony\Component\Mime\Email
    {
        return (new \Symfony\Component\Mime\Email())->subject('Hello Email')->from(new \Symfony\Component\Mime\Address('send@example.com', 'Sender'))
            ->priority(2)->to(new \Symfony\Component\Mime\Address('recipient@example.com', 'Recipient'), new \Symfony\Component\Mime\Address('recipient2@example.com'))
            ->cc(new \Symfony\Component\Mime\Address('cc@example.com', 'CC'))
            ->addCc(new \Symfony\Component\Mime\Address('cc2@example.com'))
            ->html($this->renderView('emails/registration.html.twig', ['name' => $name]));
    }
}

?>
