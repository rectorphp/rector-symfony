<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject\ValidatorAssert;

use PhpParser\Node\Expr\New_;

final readonly class PropertyAndConstraint
{
    public function __construct(
        private string $property,
        private New_ $constraintNew
    ) {
    }

    public function getProperty(): string
    {
        return $this->property;
    }

    public function getConstraintNew(): New_
    {
        return $this->constraintNew;
    }
}
