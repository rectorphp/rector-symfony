<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

class SimpleMessage {
    public function createMessage(): \Swift_Message
    {
        $message = new \Swift_Message();
        $message->setSubject('subject');
        $message->setFrom('send@example.com');

        return $message;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

class SimpleMessage {
    public function createMessage(): \Symfony\Component\Mime\Email
    {
        $message = new \Symfony\Component\Mime\Email();
        $message->subject('subject');
        $message->from(new \Symfony\Component\Mime\Address('send@example.com'));

        return $message;
    }
}

?>
