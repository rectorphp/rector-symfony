<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class SkipClosureConstraint
{
    private $slotName;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        // a closure is not a constant expression, an attribute cannot hold it
        $metadata->addConstraint(new Callback(
            function (self $self, ExecutionContextInterface $context): void {
                $context->buildViolation('nope')
                    ->atPath('slotName')
                    ->addViolation();
            },
        ));
    }
}
