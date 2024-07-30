<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\ParameterBagToAutowireAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class SomeParameterBag
{
    private $someKey;

    public function __construct(
        ParameterBagInterface $parameterBag
    ) {
        $this->someKey = $parameterBag->get('some_key');
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\ParameterBagToAutowireAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class SomeParameterBag
{
    private $someKey;

    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'some_key')]
        $someKey
    ) {
        $this->someKey = $someKey;
    }
}

?>
