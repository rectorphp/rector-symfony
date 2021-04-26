<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class SomeController2
{
    /**
     * @DI\Inject("Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeEntityManager")
     */
    private $entityManager;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class SomeController2
{
    public function __construct(private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeEntityManager $entityManager)
    {
    }
}

?>
