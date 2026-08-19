<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\OptionNameRector\Fixture;

use Rector\Symfony\Tests\Symfony30\Rector\MethodCall\OptionNameRector\Source\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SkipNoOldOption extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('price1', 'text', array(
            'label' => 'form.price1',
            'scale' => 3,
        ));
    }
}
