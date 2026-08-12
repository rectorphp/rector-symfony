<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipClosureCallbackWithMovableConstraint
{
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('city', new Assert\NotBlank());
        $metadata->addConstraint(new Callback(
            function (self $self, ExecutionContextInterface $context): void {
                $context->buildViolation('nope')
                    ->atPath('city')
                    ->addViolation();
            },
        ));
    }
}
