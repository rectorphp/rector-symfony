<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\New_\RemoveEraseCredentialsFromAuthenticatorManagerRector\Fixture;

use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel;

final class Foo
{
    public function bar(): void
    {
        new AuthenticatorManager(
            $authenticators,
            $tokenStorage,
            $eventDispatcher,
            $firewallName,
            null,
            ExposeSecurityLevel::All
        );                                
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\New_\RemoveEraseCredentialsFromAuthenticatorManagerRector\Fixture;

use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authentication\ExposeSecurityLevel;

final class Foo
{
    public function bar(): void
    {
        new AuthenticatorManager(
            $authenticators,
            $tokenStorage,
            $eventDispatcher,
            $firewallName,
            null,
            ExposeSecurityLevel::All
        );                                
    }
}

?>
