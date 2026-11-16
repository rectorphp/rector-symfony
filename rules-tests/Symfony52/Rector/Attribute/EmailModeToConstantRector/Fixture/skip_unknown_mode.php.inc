<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\Attribute\EmailModeToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final class SkipUnknownMode
{
    #[Email(mode: 'unknown')]
    public $unknown;

    #[Email(mode: Email::VALIDATION_MODE_HTML5)]
    public $already;

    #[NotBlank(message: 'strict')]
    public $other;
}
