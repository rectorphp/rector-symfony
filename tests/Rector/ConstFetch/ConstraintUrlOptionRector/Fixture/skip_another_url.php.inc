<?php

namespace Rector\Symfony\Tests\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

function constraintUrlOptionRector()
{
    $containt = new Url(['checkDNS' => true]);
}
