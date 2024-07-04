<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class AnotherConfiguredService
{
    public function __construct(
        private $someParameter
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class AnotherConfiguredService
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: 'SOME_PARAM')]
        private $someParameter
    ) {
    }
}

?>
