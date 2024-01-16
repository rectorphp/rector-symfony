<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use Rector\Validation\RectorAssert;
use Webmozart\Assert\Assert;

final readonly class IntlBundleClassToNewClass
{
    /**
     * @param array<string, string> $oldToNewMethods
     */
    public function __construct(
        private string $oldClass,
        private string $newClass,
        private array $oldToNewMethods
    ) {
        RectorAssert::className($oldClass);
        RectorAssert::className($newClass);

        Assert::allString($oldToNewMethods);
        Assert::allString(array_keys($oldToNewMethods));
    }

    public function getOldClass(): string
    {
        return $this->oldClass;
    }

    public function getNewClass(): string
    {
        return $this->newClass;
    }

    /**
     * @return array<string, string>
     */
    public function getOldToNewMethods(): array
    {
        return $this->oldToNewMethods;
    }
}
