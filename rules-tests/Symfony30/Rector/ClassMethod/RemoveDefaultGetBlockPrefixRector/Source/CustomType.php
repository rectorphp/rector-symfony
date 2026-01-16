<?php
declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Source;

use Symfony\Component\Form\AbstractType;

final class CustomType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'custom';
    }
}
