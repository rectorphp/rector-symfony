<?php

declare(strict_types=1);

namespace Rector\Symfony\Symfony73\ValueObject;

use PhpParser\Node\Arg;
use PhpParser\Node\Stmt\ClassMethod;

final readonly class AsTwigAttributeConversion
{
    /**
     * @param Arg[] $optionArgs
     */
    public function __construct(
        private int $itemKey,
        private ClassMethod $classMethod,
        private Arg $nameArg,
        private array $optionArgs
    ) {
    }

    public function getItemKey(): int
    {
        return $this->itemKey;
    }

    public function getClassMethod(): ClassMethod
    {
        return $this->classMethod;
    }

    public function getNameArg(): Arg
    {
        return $this->nameArg;
    }

    /**
     * @return Arg[]
     */
    public function getOptionArgs(): array
    {
        return $this->optionArgs;
    }
}
