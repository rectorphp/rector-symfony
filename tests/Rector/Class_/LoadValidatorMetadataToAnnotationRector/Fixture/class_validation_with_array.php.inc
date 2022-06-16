<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class ClassValidationWithArray
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addConstraint(new Assert\Callback(['validateCity']));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @Assert\Callback("validateCity")
 */
final class ClassValidationWithArray
{
}

?>
