<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\New_\RemoveEraseCredentialsFromAuthenticatorManagerRector\Fixture;

use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

final class Foo
{
    public function bar(): void
    {
        new AuthenticatorManager(
            authenticators: $authenticators,
            tokenStorageInterface: $tokenStorage,
            eventDispatcherInterface: $eventDispatcher,
            firewallName: $firewallName,
            exposeSecurityErrors: false
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
            authenticators: $authenticators,
            tokenStorageInterface: $tokenStorage,
            eventDispatcherInterface: $eventDispatcher,
            firewallName: $firewallName
        );                                
    }
}

?>
