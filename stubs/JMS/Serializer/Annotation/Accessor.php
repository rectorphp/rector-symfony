<?php

namespace JMS\Serializer\Annotation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Accessor
{
    public function __construct(array $values = [], ?string $getter = null, ?string $setter = null)
    {
    }
}
