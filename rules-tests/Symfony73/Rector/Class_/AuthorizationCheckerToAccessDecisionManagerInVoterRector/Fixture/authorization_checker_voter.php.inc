<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AuthorizationCheckerToAccessDecisionManagerInVoterRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class AuthorizationCheckerVoter extends Voter
{
    public function __construct(
        private AuthorizationCheckerInterface $authorizationChecker
    ) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        return $this->authorizationChecker->isGranted('ROLE_ADMIN');
    }
}
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AuthorizationCheckerToAccessDecisionManagerInVoterRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class AuthorizationCheckerVoter extends Voter
{
    public function __construct(
        private \Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface $accessDecisionManager
    ) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        return $this->accessDecisionManager->decide($token, ['ROLE_ADMIN']);
    }
}
