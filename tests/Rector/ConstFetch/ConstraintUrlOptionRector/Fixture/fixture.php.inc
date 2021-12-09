<?php

namespace Rector\Symfony\Tests\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

use Symfony\Component\Validator\Constraints\Url;

function constraintUrlOptionRector()
{
    $containt = new Url(['checkDNS' => true]);
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

use Symfony\Component\Validator\Constraints\Url;

function constraintUrlOptionRector()
{
    $containt = new Url(['checkDNS' => \Symfony\Component\Validator\Constraints\Url::CHECK_DNS_TYPE_ANY]);
}

?>
