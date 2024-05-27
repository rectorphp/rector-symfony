<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

final class SkipAttachmentHandler
{
    public function attachString(\stdClass $message) : \stdClass
    {
        $message->attach('string');
        return $message;
    }
}
