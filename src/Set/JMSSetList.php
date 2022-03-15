<?php

declare(strict_types=1);

namespace Rector\Symfony\Set;

use Rector\Set\Contract\SetListInterface;

final class JMSSetList implements SetListInterface
{
    /**
     * @var string
     */
    final public const REMOVE_JMS_INJECT = __DIR__ . '/../../config/sets/jms/remove-jms-inject.php';

    /**
     * @var string
     */
    final public const ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/jms/annotations-to-attributes.php';
}
