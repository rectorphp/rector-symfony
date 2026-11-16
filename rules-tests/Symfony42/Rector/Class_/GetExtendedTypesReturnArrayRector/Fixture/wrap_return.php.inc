<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\Class_\GetExtendedTypesReturnArrayRector\Fixture;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;

final class WrapReturn extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return FormType::class;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\Class_\GetExtendedTypesReturnArrayRector\Fixture;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;

final class WrapReturn extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [FormType::class];
    }
}

?>
