<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\StaticPropertyFetch\ErrorNamesPropertyToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

final class Replace extends NotBlank
{
    public function __construct(array $options = null, string $message = null, bool $allowNull = null, callable $normalizer = null, array $groups = null, mixed $payload = null)
    {
        $message = NotBlank::$errorNames;

        parent::__construct($options, $message, $allowNull, $normalizer, $groups, $payload);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\StaticPropertyFetch\ErrorNamesPropertyToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints\NotBlank;

final class Replace extends NotBlank
{
    public function __construct(array $options = null, string $message = null, bool $allowNull = null, callable $normalizer = null, array $groups = null, mixed $payload = null)
    {
        $message = \Symfony\Component\Validator\Constraints\NotBlank::ERROR_NAMES;

        parent::__construct($options, $message, $allowNull, $normalizer, $groups, $payload);
    }
}

?>
