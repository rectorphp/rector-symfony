<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

class SkipNonSwiftMailerCreateMessage
{
    private $swift;

    public function __construct(\stdClass $swift)
    {
        $this->swift = $swift;
    }

    public function createMessage()
    {
        $email = $this->swift->createMessage('message');
    }
}

?>
