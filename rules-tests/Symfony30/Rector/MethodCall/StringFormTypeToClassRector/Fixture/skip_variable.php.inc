<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\StringFormTypeToClassRector\Fixture;

use Symfony\Component\Form\FormBuilder;

final class SkipVariable
{
    public function action()
    {
        $variable = 'form.type.text';
    }
}
