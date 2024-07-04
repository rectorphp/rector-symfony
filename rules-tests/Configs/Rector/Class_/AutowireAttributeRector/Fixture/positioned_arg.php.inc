<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class PositionedArg
{
    public function __construct(
        private $anything,
        private $canBeHere
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class PositionedArg
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'first_item')]
        private $anything,
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'second_item')]
        private $canBeHere
    ) {
    }
}

?>
