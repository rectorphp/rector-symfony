<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\AccessType;

final class JMSAnnotation
{
    public const ACCESS_TYPE = AccessType::class;

    public const ACCESSOR = Accessor::class;
}
