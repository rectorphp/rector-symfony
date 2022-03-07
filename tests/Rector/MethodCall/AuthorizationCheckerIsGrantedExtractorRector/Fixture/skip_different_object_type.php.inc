<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Source\DifferentClass;

class SkipDifferentObjectType
{
    public function run(DifferentClass $differentClass)
    {
        $differentClass->isGranted(['a']);
    }
}
