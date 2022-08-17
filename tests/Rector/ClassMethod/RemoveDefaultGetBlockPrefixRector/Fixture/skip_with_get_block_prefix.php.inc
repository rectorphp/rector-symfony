<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

use Symfony\Component\Form\AbstractType;

class IconType extends ChoiceType
{
    public function getBlockPrefix()
    {
        return 'icon';
    }
}

class ChoiceType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'something';
    }
}
