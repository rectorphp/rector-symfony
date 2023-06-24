<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\Form\FormBuilderInterface;

final class SomeClass
{
    public function detail(FormBuilderInterface $formBuilder)
    {
        $formBuilder->setMethod('GET');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\MethodCall\LiteralGetToRequestClassConstantRector\Fixture;

use Symfony\Component\Form\FormBuilderInterface;

final class SomeClass
{
    public function detail(FormBuilderInterface $formBuilder)
    {
        $formBuilder->setMethod(\Symfony\Component\HttpFoundation\Request::METHOD_GET);
    }
}

?>
