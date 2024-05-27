<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

interface SimpleEmailInterface
{
    public function sendMessage(\Swift_Message $message);
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

interface SimpleEmailInterface
{
    public function sendMessage(\Symfony\Component\Mime\Email $message);
}

?>
