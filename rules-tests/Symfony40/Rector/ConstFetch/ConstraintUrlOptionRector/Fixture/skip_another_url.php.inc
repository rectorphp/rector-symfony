<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

function constraintUrlOptionRector()
{
    $constraint = new Url(['checkDNS' => true]);
}
