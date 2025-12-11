<?php

use Symfony\Component\Validator\Constraints\Email;

class EmailModeLooseToHtml5
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_LOOSE)]
    public function run(): void
    {
    }
}

?>
-----
<?php

use Symfony\Component\Validator\Constraints\Email;

class EmailModeLooseToHtml5
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_HTML5)]
    public function run(): void
    {
    }
}

?>
