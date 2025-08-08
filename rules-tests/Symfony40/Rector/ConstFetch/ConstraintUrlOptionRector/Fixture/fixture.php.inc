<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

use Symfony\Component\Validator\Constraints\Url;

function constraintUrlOptionRector()
{
    $constraint = new Url(['checkDNS' => true]);
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

use Symfony\Component\Validator\Constraints\Url;

function constraintUrlOptionRector()
{
    $constraint = new Url(['checkDNS' => \Symfony\Component\Validator\Constraints\Url::CHECK_DNS_TYPE_ANY]);
}

?>
