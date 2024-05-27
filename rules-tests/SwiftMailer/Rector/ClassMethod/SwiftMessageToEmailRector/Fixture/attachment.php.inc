<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AttachmentHandler
{
    public function addImage(\Swift_Message $message) : \Swift_Message
    {
        $message->attach(\Swift_Attachment::fromPath('/path/to/image.jpg')->setContentType('image/jpeg')->setFilename('cool.jpg'));
        return $message;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AttachmentHandler
{
    public function addImage(\Symfony\Component\Mime\Email $message) : \Symfony\Component\Mime\Email
    {
        $message->attachFromPath('/path/to/image.jpg', 'cool.jpg', 'image/jpeg');
        return $message;
    }
}

?>
