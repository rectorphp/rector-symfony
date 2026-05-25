<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\StaticCall\AddFormatArgumentToIsValidRector\Fixture;

use Symfony\Component\Uid\Ulid;

final class Foo
{
    public function bar(string $id): bool
    {
        return Ulid::isValid($id);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\StaticCall\AddFormatArgumentToIsValidRector\Fixture;

use Symfony\Component\Uid\Ulid;

final class Foo
{
    public function bar(string $id): bool
    {
        return Ulid::isValid($id, \Symfony\Component\Uid\Ulid::FORMAT_BASE_32);
    }
}

?>
