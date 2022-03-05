<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Set\TwigExtensionNamespace\Fixture;

final class RenameTwigExtension extends \Twig_Extension
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Set\TwigExtensionNamespace\Fixture;

final class RenameTwigExtension extends \Twig\Extension\AbstractExtension
{
}

?>
