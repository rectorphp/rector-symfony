<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class ClassWithInjects35
{
    /**
     * @DI\Inject
     */
    private $translator;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class ClassWithInjects35
{
    public function __construct(private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeTranslatorInterface $translator)
    {
    }
}

?>
