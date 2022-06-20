<?php

namespace Rector\Symfony\Tests\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TerminologyExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', [$this, 'resolve']),
        ];
    }

    public function resolve($value)
    {
        $value++;
        return $value + 100;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\MagicClosureTwigExtensionToNativeMethodsRector\Fixture;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TerminologyExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('resolve', function ($value) {
                return $this->resolve($value);
            }),
        ];
    }

    public function resolve($value)
    {
        $value++;
        return $value + 100;
    }
}

?>
