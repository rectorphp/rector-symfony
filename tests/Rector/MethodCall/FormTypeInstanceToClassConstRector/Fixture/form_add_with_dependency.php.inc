<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeTypeWithCtor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;

final class SomeAnotherControllerWithArgs extends Controller
{
    public function action(FormBuilder $builder)
    {
        $builder->add('someText', new SomeTypeWithCtor(1));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeTypeWithCtor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilder;

final class SomeAnotherControllerWithArgs extends Controller
{
    public function action(FormBuilder $builder)
    {
        $builder->add('someText', \Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeTypeWithCtor::class, ['number' => 1]);
    }
}

?>
