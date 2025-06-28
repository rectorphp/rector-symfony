<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AddVoteArgumentToVoteOnAttributeRector\Fixture;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class MyVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        return true;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AddVoteArgumentToVoteOnAttributeRector\Fixture;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class MyVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token, ?\Symfony\Component\Security\Core\Authorization\Voter\Vote $vote = null): bool
    {
        return true;
    }
}

?>
