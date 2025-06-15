<?php

namespace Rector\Symfony\Tests\JMS\Rector\Property\AccessorAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

final class KeepGivenKey
{
    /**
     * @Serializer\Accessor(setter="setSome")
     */
    private $value;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\JMS\Rector\Property\AccessorAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

final class KeepGivenKey
{
    #[Serializer\Accessor(setter: 'setSome')]
    private $value;
}

?>
