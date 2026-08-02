<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

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

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[\Symfony\Component\Validator\Constraints\Callback('validatePostalCode')]
final class ClassValidation
{
}

?>
