<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

final class SomeController
{
    /**
     * @DI\Inject("entity.manager")
     */
    private $entityManager;

    /**
     * @DI\Inject("translator", strict = false, required = false)
     */
    private $translator;
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

final class SomeController
{
    public function __construct(private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeEntityManager $entityManager, private \Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Source\SomeTranslatorInterface $translator)
    {
    }
}

?>
