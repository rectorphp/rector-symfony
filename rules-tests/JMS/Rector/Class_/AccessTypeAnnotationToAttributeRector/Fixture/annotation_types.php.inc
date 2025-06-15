<?php

namespace Rector\Symfony\Tests\JMS\Rector\Class_\AccessTypeAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
final class AnnotationTypes
{
    public function run(): void
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\JMS\Rector\Class_\AccessTypeAnnotationToAttributeRector\Fixture;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\AccessType(values: ['public_method'])]
final class AnnotationTypes
{
    public function run(): void
    {
    }
}

?>
