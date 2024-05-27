<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector\Fixture;

interface SimpleEmailInterface
{
    public function sendMessage(\Swift_Message $message);
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector\Fixture;

interface SimpleEmailInterface
{
    public function sendMessage(\Symfony\Component\Mime\Email $message);
}

?>
