<?php

use Symfony\Component\Validator\Constraints\Email;

class EmailModeStrictToConst
{
    #[Email(mode: 'strict')]
    public function runStrict(): void
    {
    }
}

class EmailModeLooseToConst
{
    #[Email(mode: 'loose')]
    public function runLoose(): void
    {
    }
}

class EmailModeHtml5ToConst
{
    #[Email(mode: 'html5')]
    public function runHtml5(): void
    {
    }
}

?>
-----
<?php

use Symfony\Component\Validator\Constraints\Email;

class EmailModeStrictToConst
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_STRICT)]
    public function runStrict(): void
    {
    }
}

class EmailModeLooseToConst
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_LOOSE)]
    public function runLoose(): void
    {
    }
}

class EmailModeHtml5ToConst
{
    #[Email(mode: \Symfony\Component\Validator\Constraints\Email::VALIDATION_MODE_HTML5)]
    public function runHtml5(): void
    {
    }
}

?>
