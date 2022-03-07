<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SkipNamedArgs
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted(subject: 'test', isGranted: ['a']);
    }
}
