<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ActionSuffixRemoverRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkipGetAction extends Controller
{
    public function getAction()
    {
    }
}
