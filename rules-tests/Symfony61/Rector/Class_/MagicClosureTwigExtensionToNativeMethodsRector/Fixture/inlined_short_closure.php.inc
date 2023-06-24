<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class InlinedShortClosure extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', [$this, 'resolve']),
        ];
    }

    public function resolve($value)
    {
        return $value + 100;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class InlinedShortClosure extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', $this->resolve(...)),
        ];
    }

    public function resolve($value)
    {
        return $value + 100;
    }
}

?>
