<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\ParameterBagToAutowireAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class KeepParameterBagIfUsd
{
    private $someKey;

    public function __construct(
        ParameterBagInterface $parameterBag
    ) {
        $this->someKey = $parameterBag->get('some_key');

        if ($parameterBag->has('some_other_key')) {
            return;
        }
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\ParameterBagToAutowireAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class KeepParameterBagIfUsd
{
    private $someKey;

    public function __construct(
        ParameterBagInterface $parameterBag, #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'some_key')]
        $someKey
    ) {
        $this->someKey = $someKey;

        if ($parameterBag->has('some_other_key')) {
            return;
        }
    }
}

?>
