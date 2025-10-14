<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

final class OnCollection
{
    public function run(bool $param)
    {
        $constraints = new Assert\Collection([
            'example1' => [new Assert\NotBlank(), new Assert\Type('string')],
            'example2' => [new Assert\Type('string')],
            'example3' => [new Assert\NotBlank(), new Assert\Type('string')],
            'example4' => [new Assert\NotBlank(), new Assert\Type('string')],
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

final class OnCollection
{
    public function run(bool $param)
    {
        $constraints = new Assert\Collection(fields: [
            'example1' => [new Assert\NotBlank(), new Assert\Type('string')],
            'example2' => [new Assert\Type('string')],
            'example3' => [new Assert\NotBlank(), new Assert\Type('string')],
            'example4' => [new Assert\NotBlank(), new Assert\Type('string')],
        ]);
    }
}

?>
