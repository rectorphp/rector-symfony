<?php

namespace Symfony\Component\Serializer\Normalizer;

if (interface_exists('Symfony\Component\Serializer\Normalizer\DenormalizerInterface')) {
    return;
}

interface DenormalizerInterface
{
}
