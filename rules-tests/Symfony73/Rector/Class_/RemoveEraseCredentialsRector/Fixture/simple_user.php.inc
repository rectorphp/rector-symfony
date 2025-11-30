<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class SimpleUser implements UserInterface
{
    public function getRoles(): array
    {
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class SimpleUser implements UserInterface
{
    public function getRoles(): array
    {
    }

    public function getUserIdentifier(): string
    {
    }
}

?>
