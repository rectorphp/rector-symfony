<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\MethodCall\SwiftCreateMessageToNewEmailRector\Fixture;

final class SkipNonSwiftMailerCreateMessage
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
