<?php

namespace Symfony\Component\Serializer\Normalizer;

if (interface_exists('Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface')) {
    return;
}

interface ContextAwareNormalizerInterface
{
}
