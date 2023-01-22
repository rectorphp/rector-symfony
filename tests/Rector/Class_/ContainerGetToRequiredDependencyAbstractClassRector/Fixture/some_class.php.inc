<?php

namespace Rector\Symfony\Tests\Rector\Class_\ContainerGetToRequiredDependencyAbstractClassRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CustomAbstractController extends AbstractController
{
    public function run()
    {
        $this->get('some_name')->apply();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\ContainerGetToRequiredDependencyAbstractClassRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CustomAbstractController extends AbstractController
{
    private \App\\SomeType $someType;
    /**
     * @required
     */
    public function autowire(\App\\SomeType $someType)
    {
        $this->someType = $someType;
    }
    public function run()
    {
        $this->someType->apply();
    }
}

?>
