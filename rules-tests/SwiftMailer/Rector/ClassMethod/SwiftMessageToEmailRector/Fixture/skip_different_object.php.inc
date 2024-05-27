<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

final class SkipDifferentObject
{
    public function setSubject(\stdClass $message) : \stdClass
    {
        $message->setSubject('string');
        return $message;
    }

    public function attachString(\stdClass $message) : \stdClass
    {
        $message->attach('string');
        return $message;
    }
}
