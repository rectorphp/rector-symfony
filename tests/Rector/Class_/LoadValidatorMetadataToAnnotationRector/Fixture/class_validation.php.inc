<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class ClassValidation
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new Assert\Callback('validatePostalCode'));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @Assert\Callback("validatePostalCode")
 */
final class ClassValidation
{
}

?>
