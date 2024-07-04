<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class MultiArgs
{
    public function __construct(
        private $someService,
        private $realParameter,
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class MultiArgs
{
    public function __construct(
        private $someService,
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'timeout')]
        private $realParameter,
    ) {
    }
}

?>
