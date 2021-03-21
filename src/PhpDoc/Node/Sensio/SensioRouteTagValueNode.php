<?php

declare(strict_types=1);

namespace Rector\Symfony\PhpDoc\Node\Sensio;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\ShortNameAwareTagInterface;
use Rector\BetterPhpDocParser\Contract\PhpDocNode\SilentKeyNodeInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;

/**
 * @see https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/routing.html
 */
final class SensioRouteTagValueNode extends AbstractTagValueNode implements ShortNameAwareTagInterface, SilentKeyNodeInterface
{
    public function getShortName(): string
    {
        return '@Route';
    }

    public function getSilentKey(): string
    {
        return 'path';
    }

    public function removeService(): void
    {
        unset($this->items['service']);
    }
}
