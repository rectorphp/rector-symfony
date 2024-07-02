<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class SomeConfiguredService
{
    public function __construct(
        private int $timeout,
        private string $key
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class SomeConfiguredService
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'timeout')]
        private int $timeout,
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(env: 'APP_KEY')]
        private string $key
    ) {
    }
}

?>
