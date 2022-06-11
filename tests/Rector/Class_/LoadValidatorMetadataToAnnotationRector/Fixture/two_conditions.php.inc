<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class TwoConditions
{
    private $email;

    public function getEmail()
    {
        return $this->email;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addGetterConstraint(
            'email',
            new Assert\NotBlank(
                [
                    'message' => 'Email can\'t be blank.',
                    'groups' => ['basic'],
                ]
            )
        );

        $metadata->addGetterConstraint(
            'email',
            new Assert\Email([
                'message' => 'The email {{ value }} is not a valid email.',
                'checkMX' => true,
                'strict' => true,
            ])
        );
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\LoadValidatorMetadataToAnnotationRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

final class TwoConditions
{
    private $email;

    /**
     * @Assert\NotBlank(message="Email can't be blank.", groups={"basic"})
     * @Assert\Email(message="The email {{ value }} is not a valid email.", checkMX=true, strict=true)
     */
    public function getEmail()
    {
        return $this->email;
    }
}

?>
