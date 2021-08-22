<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

class Fixture
{
    public function __construct(\Swift_Mailer $swift)
    {
        $this->swift = $swift;
    }

    public function createMessage()
    {
        $email = $this->swift->createMessage('message');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

class Fixture
{
    public function __construct(\Swift_Mailer $swift)
    {
        $this->swift = $swift;
    }

    public function createMessage()
    {
        $email = (new \Symfony\Component\Mime\Email())->subject('message');
    }
}

?>
