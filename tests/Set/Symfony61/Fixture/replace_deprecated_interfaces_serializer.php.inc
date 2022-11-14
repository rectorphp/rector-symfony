<?php

namespace Rector\Symfony\Tests\Set\Symfony61\Fixture;

use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReplaceDepricatedInterfacesSerializer implements DenormalizerInterface, NormalizerInterface, ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface
{
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony61\Fixture;

use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReplaceDepricatedInterfacesSerializer implements DenormalizerInterface, NormalizerInterface
{
}

?>
