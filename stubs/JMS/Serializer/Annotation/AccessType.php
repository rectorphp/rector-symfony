<?php

namespace JMS\Serializer\Annotation;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_PROPERTY)]
class AccessType
{
    public function __construct(array $values = [], ?string $type = null)
    {
    }
}
