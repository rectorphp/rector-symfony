<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SkipNamedArgs
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->isGranted(subject: 'test', isGranted: ['a']);
    }
}
