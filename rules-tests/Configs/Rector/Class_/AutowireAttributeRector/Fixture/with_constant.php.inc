<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class WithConstant
{
    public function __construct(
        private $googleKey
    ) {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Fixture;

final class WithConstant
{
    public function __construct(
        #[\Symfony\Component\DependencyInjection\Attribute\Autowire(param: \Rector\Symfony\Tests\Configs\Rector\Class_\AutowireAttributeRector\Source\ParameterName::GOOGLE_KEY)]
        private $googleKey
    ) {
    }
}

?>
