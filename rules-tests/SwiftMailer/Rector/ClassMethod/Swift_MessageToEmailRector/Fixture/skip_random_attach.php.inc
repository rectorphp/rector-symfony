<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\Swift_MessageToEmailRector\Fixture;

final class SkipAttachmentHandler
{
    public function attachString(\stdClass $message) : \stdClass
    {
        $message->attach('string');
        return $message;
    }
}
