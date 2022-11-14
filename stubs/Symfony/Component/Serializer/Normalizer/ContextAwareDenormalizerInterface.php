<?php

namespace Symfony\Component\Serializer\Normalizer;

if (interface_exists('Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface')) {
    return;
}

interface ContextAwareDenormalizerInterface
{
}
