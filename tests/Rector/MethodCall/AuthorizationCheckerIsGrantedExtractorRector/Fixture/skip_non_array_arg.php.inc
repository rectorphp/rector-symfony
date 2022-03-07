<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SkipNonArrayArg
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface, string $value)
    {
        $authorizationCheckerInterface->isGranted($value);
    }
}
