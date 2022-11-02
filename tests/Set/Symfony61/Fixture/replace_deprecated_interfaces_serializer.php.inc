<?php

namespace Rector\Symfony\Tests\Set\Symfony61\Fixture;

use Symfony\Component\Serializer\Normalizer\ContextAwareDecoderInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReplaceDepricatedInterfacesSerializer implements DecoderInterface, DenormalizerInterface, EncoderInterface, NormalizerInterface, ContextAwareDecoderInterface, ContextAwareEncoderInterface, ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony61\Fixture;


use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReplaceDepricatedInterfacesSerializer implements DecoderInterface, DenormalizerInterface, EncoderInterface, NormalizerInterface
{
}

?>
