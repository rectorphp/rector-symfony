<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\DeprecatedCallableInfo;
use Twig\Environment;
use Twig\Node\Node;
use Twig\Extension\AbstractExtension;

final class WithOptionsParameter extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('with_environment', $this->withEnvironment(...), ['needs_environment' => true]),
            new \Twig\TwigFunction('with_context', [$this, 'withContext'], ['needs_context' => true]),
            new \Twig\TwigFunction('with_charset', [$this, 'withCharset'], ['needs_charset' => true]),
            new \Twig\TwigFunction('with_safe_callback', [$this, 'withSafeCallback'], ['is_safe_callback' => [self::class, 'checkSafeCallback']]),
            new \Twig\TwigFunction('with_deprecation_info', [$this, 'withDeprecationInfo'], ['deprecation_info' => new DeprecatedCallableInfo('package', 'version')]),
            new \Twig\TwigFunction('with_everything', [$this, 'withEverything'], ['is_safe' => ['html'], 'needs_context' => true, 'needs_charset' => true, 'needs_environment' => true]),
        ];
    }

    public function withEnvironment(Environment $env, $value)
    {
        return $value;
    }

    public function withContext(array $context, $value)
    {
        return $value;
    }

    public function withCharset(string $charset, $value)
    {
        return $value;
    }

    public function withSafeCallback($value)
    {
        return $value;
    }

    public function withDeprecationInfo($value)
    {
        return $value;
    }

    public function withEverything(string $charset, Environment $env, array $context, $value)
    {
        return $value;
    }

    public function checkSafeCallback(Node $argsNode): array
    {
        return [];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\GetFunctionsToAsTwigFunctionAttributeRector\Fixture;

use Twig\DeprecatedCallableInfo;
use Twig\Environment;
use Twig\Node\Node;
use Twig\Extension\AbstractExtension;

final class WithOptionsParameter
{
    #[\Twig\Attribute\AsTwigFunction(name: 'with_environment', needsEnvironment: true)]
    public function withEnvironment(Environment $env, $value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'with_context', needsContext: true)]
    public function withContext(array $context, $value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'with_charset', needsCharset: true)]
    public function withCharset(string $charset, $value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'with_safe_callback', isSafeCallback: [self::class, 'checkSafeCallback'])]
    public function withSafeCallback($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'with_deprecation_info', deprecationInfo: new DeprecatedCallableInfo('package', 'version'))]
    public function withDeprecationInfo($value)
    {
        return $value;
    }

    #[\Twig\Attribute\AsTwigFunction(name: 'with_everything', isSafe: ['html'], needsContext: true, needsCharset: true, needsEnvironment: true)]
    public function withEverything(string $charset, Environment $env, array $context, $value)
    {
        return $value;
    }

    public function checkSafeCallback(Node $argsNode): array
    {
        return [];
    }
}

?>
