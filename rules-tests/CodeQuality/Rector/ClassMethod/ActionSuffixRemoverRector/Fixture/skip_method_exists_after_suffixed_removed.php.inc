<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ActionSuffixRemoverRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkipMethodExistsAfterSuffixedRemoved extends Controller
{
    public function indexAction()
    {
        $this->index();
    }

    private function index()
    {
    }
}
