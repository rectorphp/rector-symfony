<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class ClassWithPublicInjects
{
    /**
     * @DI\Inject
     */
    public $translator;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class ClassWithPublicInjects
{
    public function __construct(public \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeTranslatorInterface $translator)
    {
    }
}

?>
