<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\ParamAndEnvAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class SimpleConvert
{
    public function __construct(
        #[Autowire('%kernel.debug%')]
        bool $debugMode,

        #[Autowire('%env(SOME_ENV_VAR)%')]
        string $senderName,
    ) {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\ParamAndEnvAttributeRector\Fixture;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class SimpleConvert
{
    public function __construct(
        #[Autowire(param: 'kernel.debug')]
        bool $debugMode,

        #[Autowire(env: 'SOME_ENV_VAR')]
        string $senderName,
    ) {
    }
}

?>
