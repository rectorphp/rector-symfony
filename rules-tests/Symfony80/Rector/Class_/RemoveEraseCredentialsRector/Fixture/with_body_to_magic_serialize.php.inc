<?php

namespace Rector\Symfony\Tests\Symfony80\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class WithBodyToMagicSerialize implements UserInterface
{
    private ?string $plainPassword = null;

    private string $password;

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);

        return $data;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony80\Rector\Class_\RemoveEraseCredentialsRector\Fixture;

use Symfony\Component\Security\Core\User\UserInterface;

final class WithBodyToMagicSerialize implements UserInterface
{
    private ?string $plainPassword = null;

    private string $password;

    public function __serialize(): array
    {
        $this->plainPassword = null;
        $data = (array) $this;
        $data["\0" . self::class . "\0password"] = hash('crc32c', $this->password);

        return $data;
    }
}

?>
