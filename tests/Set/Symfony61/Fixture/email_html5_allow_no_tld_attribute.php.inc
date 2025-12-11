<?php

use Symfony\Component\Validator\Constraints\Email;

class Html5AllowNoTld
{
    #[Email(mode: 'html5-allow-no-tld')]
    public function run(): void
    {
    }
}

?>
-----
<?php

use Symfony\Component\Validator\Constraints\Email;

class Html5AllowNoTld
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_HTML5_ALLOW_NO_TLD)]
    public function run(): void
    {
    }
}

?>
