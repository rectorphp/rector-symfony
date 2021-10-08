<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetParameterToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ClassWithNamedService1 extends AbstractController
{
    public function render()
    {
        $value = $this->getParameter('some_parameter');

        return [
            'value' => $this->getParameter('some_parameter'),
            'value2' => $value,
        ];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\GetParameterToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ClassWithNamedService1 extends AbstractController
{
    public function __construct(private string $someParameter)
    {
    }
    public function render()
    {
        $value = $this->someParameter;

        return [
            'value' => $this->someParameter,
            'value2' => $value,
        ];
    }
}

?>
