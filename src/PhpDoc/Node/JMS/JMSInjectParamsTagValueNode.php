<?php

declare(strict_types=1);

namespace Rector\Symfony\PhpDoc\Node\JMS;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\ShortNameAwareTagInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;

/**
 * @see https://jmsyst.com/bundles/JMSDiExtraBundle/master/annotations#injectparams
 */
final class JMSInjectParamsTagValueNode extends AbstractTagValueNode implements ShortNameAwareTagInterface
{
    public function getShortName(): string
    {
        return '@DI\InjectParams';
    }
}
