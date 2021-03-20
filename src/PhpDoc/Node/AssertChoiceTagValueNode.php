<?php

declare(strict_types=1);

namespace Rector\Symfony\PhpDoc\Node;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\ShortNameAwareTagInterface;
use Rector\BetterPhpDocParser\Contract\PhpDocNode\SilentKeyNodeInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;

/**
 * @see \Rector\Tests\BetterPhpDocParser\PhpDocParser\TagValueNodeReprint\TagValueNodeReprintTest
 */
final class AssertChoiceTagValueNode extends AbstractTagValueNode implements ShortNameAwareTagInterface, SilentKeyNodeInterface
{
    public function isCallbackClass(string $class): bool
    {
        return $class === ($this->items['callback'][0] ?? null);
    }

    public function changeCallbackClass(string $newClass): void
    {
        $this->items['callback'][0] = $newClass;
    }

    public function getShortName(): string
    {
        return '@Assert\Choice';
    }

    public function getSilentKey(): string
    {
        return 'choices';
    }
}
