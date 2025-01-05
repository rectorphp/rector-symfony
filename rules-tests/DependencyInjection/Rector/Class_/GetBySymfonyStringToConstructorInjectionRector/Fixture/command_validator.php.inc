<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

final class CommandValidator extends ContainerAwareCommand
{
    public function configure()
    {
        $someType = $this->get('validator');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Class_\GetBySymfonyStringToConstructorInjectionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

final class CommandValidator extends ContainerAwareCommand
{
    public function __construct(private readonly \Symfony\Component\Validator\Validator\ValidatorInterface $validator)
    {
    }
    public function configure()
    {
        $someType = $this->validator;
    }
}

?>
