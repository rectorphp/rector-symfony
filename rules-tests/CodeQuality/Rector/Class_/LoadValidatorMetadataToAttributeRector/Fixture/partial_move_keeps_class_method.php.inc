<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class PartialMoveKeepsClassMethod
{
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('city', new Assert\NotBlank());
        $metadata->addPropertyConstraint('unknownProperty', new Assert\NotBlank());
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\LoadValidatorMetadataToAttributeRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class PartialMoveKeepsClassMethod
{
    #[\Symfony\Component\Validator\Constraints\NotBlank]
    private $city;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('unknownProperty', new Assert\NotBlank());
    }
}

?>
