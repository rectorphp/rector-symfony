<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeProductWithInterface;

class ClassWithInjects7
{
    /**
     * @var SomeInterface
     * @DI\Inject("irelevant")
     */
    private $session;

    /**
     * @var SomeProductWithInterface
     * @DI\Inject
     */
    private $product;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeProductWithInterface;

class ClassWithInjects7
{
    public function __construct(private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeInterface $session, private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeProductWithInterface $product)
    {
    }
}

?>
