<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PreferRequiredSetter extends Controller
{
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @required
     */
    public function autowire(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function configure()
    {
        $someType = $this->get('validator');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PreferRequiredSetter extends Controller
{
    private EventDispatcherInterface $eventDispatcher;
    private \Symfony\Component\Validator\Validator\ValidatorInterface $validator;

    /**
     * @required
     */
    public function autowire(
        EventDispatcherInterface $eventDispatcher, \Symfony\Component\Validator\Validator\ValidatorInterface $validator
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->validator = $validator;
    }


    public function configure()
    {
        $someType = $this->validator;
    }
}

?>
