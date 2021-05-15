<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

final class ConstantNameAndValue
{
    /**
     * @param mixed $value
     */
    public function __construct(
        private string $name,
        private $value
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
