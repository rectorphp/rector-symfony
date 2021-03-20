<?php

declare(strict_types=1);

namespace Rector\Symfony\PhpDoc\Node;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\ShortNameAwareTagInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;

final class AssertRangeTagValueNode extends AbstractTagValueNode implements ShortNameAwareTagInterface
{
    public function getShortName(): string
    {
        return '@Assert\Range';
    }
}
