<?php

namespace Rector\Symfony\Tests\Symfony53\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

use Swift_Mailer;

final class Fixture
{
    /**
     * @var Swift_Mailer
     */
    private $swift;

    public function __construct(Swift_Mailer $swift)
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

namespace Rector\Symfony\Tests\Symfony53\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

use Swift_Mailer;

final class Fixture
{
    /**
     * @var Swift_Mailer
     */
    private $swift;

    public function __construct(Swift_Mailer $swift)
    {
        $this->swift = $swift;
    }

    public function createMessage()
    {
        $email = new \Symfony\Component\Mime\Email();
    }
}

?>
