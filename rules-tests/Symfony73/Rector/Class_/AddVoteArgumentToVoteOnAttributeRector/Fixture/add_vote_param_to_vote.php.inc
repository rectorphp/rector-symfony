<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AddVoteArgumentToVoteOnAttributeRector\Fixture;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

final class MyVoter implements VoterInterface
{
    public function vote(TokenInterface $token, mixed $subject, array $attributes): int
    {
        return 1;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\AddVoteArgumentToVoteOnAttributeRector\Fixture;

use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

final class MyVoter implements VoterInterface
{
    public function vote(TokenInterface $token, mixed $subject, array $attributes, ?\Symfony\Component\Security\Core\Authorization\Voter\Vote $vote = null): int
    {
        return 1;
    }
}

?>
