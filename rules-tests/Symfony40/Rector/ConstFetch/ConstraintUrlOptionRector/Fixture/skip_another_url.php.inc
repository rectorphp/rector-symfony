<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\ConstFetch\ConstraintUrlOptionRector\Fixture;

function constraintUrlOptionRector()
{
    $containt = new Url(['checkDNS' => true]);
}
