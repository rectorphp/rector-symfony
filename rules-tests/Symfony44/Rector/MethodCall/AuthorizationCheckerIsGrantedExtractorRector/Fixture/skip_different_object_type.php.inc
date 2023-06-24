<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Source\DifferentClass;

class SkipDifferentObjectType
{
    public function run(DifferentClass $differentClass)
    {
        $differentClass->isGranted(['a']);
    }
}
