<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class NestedArrayStrings
{
    public function getCardNumber()
    {
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addGetterConstraint(
            'cardNumber',
            new Assert\CardScheme(
                [
                    'schemes' => ['VISA', 100],
                ]
            )
        );
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class NestedArrayStrings
{
    /**
     * @Assert\CardScheme(schemes={"VISA", 100})
     */
    public function getCardNumber()
    {
    }
}

?>
