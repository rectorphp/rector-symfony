<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\IsTrue;

final class MethodIsBool
{
    public function isEnabled()
    {
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addGetterConstraint(
            'enabled',
            new IsTrue([
                'message' => 'Must be something',
            ])
        );
    }


}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\IsTrue;

final class MethodIsBool
{
    #[\Symfony\Component\Validator\Constraints\IsTrue(message: 'Must be something')]
    public function isEnabled()
    {
    }


}

?>
