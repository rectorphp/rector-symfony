<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SkipNotIsGrantedMethodCall
{
    public function run(AuthorizationCheckerInterface $authorizationCheckerInterface)
    {
        $authorizationCheckerInterface->run(['a', 'b']);
    }
}
