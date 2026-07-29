<?php

namespace Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Fixture;

use Rector\Symfony\Tests\Symfony44\Rector\MethodCall\AuthorizationCheckerIsGrantedExtractorRector\Source\DifferentClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkipCustomPermissionServiceInController extends AbstractController
{
    public function __construct(
        private DifferentClass $security
    ) {
    }

    public function someMethod()
    {
        if ($this->security->isGranted(['ROLE_USER', 'ROLE_ADMIN'])) {

        }
    }
}
