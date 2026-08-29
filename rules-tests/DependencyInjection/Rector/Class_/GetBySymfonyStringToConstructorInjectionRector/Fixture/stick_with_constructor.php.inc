<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class StickWithConstructor extends Controller
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class StickWithConstructor extends Controller
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher, private readonly \Symfony\Component\Validator\Validator\ValidatorInterface $validator,
    ) {
    }

    public function configure()
    {
        $someType = $this->validator;
    }
}

?>
