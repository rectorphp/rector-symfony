<?php

namespace Rector\Symfony\Tests\JMS\Rector\Property\AccessorAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

final class AnnotationTypes
{
    /**
     * @Serializer\Accessor("getSome")
     */
    private $value;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\JMS\Rector\Property\AccessorAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

final class AnnotationTypes
{
    #[Serializer\Accessor(getter: 'getSome')]
    private $value;
}

?>
