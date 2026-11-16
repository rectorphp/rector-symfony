<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\Attribute\EmailModeToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

final class EmailMode
{
    #[Assert\Email(mode: 'strict')]
    public $strict;

    #[Assert\Email(message: 'Invalid', mode: 'html5-allow-no-tld')]
    public $html5AllowNoTld;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\Attribute\EmailModeToConstantRector\Fixture;

use Symfony\Component\Validator\Constraints as Assert;

final class EmailMode
{
    #[Assert\Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_STRICT)]
    public $strict;

    #[Assert\Email(message: 'Invalid', mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_HTML5_ALLOW_NO_TLD)]
    public $html5AllowNoTld;
}

?>
