<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\New_\RemoveEraseCredentialsFromAuthenticatorManagerRector\Fixture;

use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

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
            true
        );                                
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\New_\RemoveEraseCredentialsFromAuthenticatorManagerRector\Fixture;

use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

final class Foo
{
    public function bar(): void
    {
        new AuthenticatorManager(
            $authenticators,
            $tokenStorage,
            $eventDispatcher,
            $firewallName,
            null
        );                                
    }
}

?>
