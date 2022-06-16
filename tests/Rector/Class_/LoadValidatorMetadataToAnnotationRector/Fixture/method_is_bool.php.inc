<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

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

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\IsTrue;

final class MethodIsBool
{
    /**
     * @IsTrue(message="Must be something")
     */
    public function isEnabled()
    {
    }


}

?>
