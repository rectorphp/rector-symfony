<?php

namespace Rector\Symfony\Tests\Symfony80\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class WithBodyToSerialize implements UserInterface
{
    private $value;

    public function getRoles(): array
    {
    }

    public function eraseCredentials()
    {
        $this->value = null;
    }

    public function getUserIdentifier(): string
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony80\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class WithBodyToSerialize implements UserInterface
{
    private $value;

    public function getRoles(): array
    {
    }

    public function getUserIdentifier(): string
    {
    }
    public function serialize()
    {
        $this->value = null;
    }
}

?>
