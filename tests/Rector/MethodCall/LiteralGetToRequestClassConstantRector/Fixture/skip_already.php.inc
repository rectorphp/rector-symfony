<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

final class SkipAlready
{
    public function detail(FormBuilderInterface $formBuilder)
    {
        $formBuilder->setMethod(Request::METHOD_GET);
    }
}
