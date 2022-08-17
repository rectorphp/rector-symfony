<?php
declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Source;

use Symfony\Component\Form\AbstractType;

class CustomType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'custom';
    }
}
