<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariable extends Controller
{
    public function action()
    {
        $someType = new SomeFormType();
        $form = $this->createForm($someType);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariable extends Controller
{
    public function action()
    {
        $form = $this->createForm(\Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\SomeFormType::class);
    }
}

?>
