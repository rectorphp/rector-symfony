<?php

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class AuthorizationCheckerIsGranted
{
    public function __construct(
        private AuthorizationCheckerInterface $authorizationChecker
    ) {
    }

    public function hasAccess(): bool
    {
        return $this->authorizationChecker->isGranted(['ROLE_USER', 'ROLE_ADMIN']);
    }
}

?>
-----
<?php

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class AuthorizationCheckerIsGranted
{
    public function __construct(
        private AuthorizationCheckerInterface $authorizationChecker
    ) {
    }

    public function hasAccess(): bool
    {
        return $this->authorizationChecker->isGranted('ROLE_USER') || $this->authorizationChecker->isGranted('ROLE_ADMIN');
    }
}

?>
