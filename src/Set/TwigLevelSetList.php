<?php

declare(strict_types=1);

namespace Rector\Symfony\Set;

use Rector\Set\Contract\SetListInterface;

/**
 * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
 * @api
 */
final class TwigLevelSetList implements SetListInterface
{
    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_112 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';

    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_127 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';

    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_134 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';

    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_140 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';

    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_20 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';

    /**
     * @deprecated Instead of too bloated and overriding level sets, use only latest Twig set
     * @var string
     */
    final public const UP_TO_TWIG_240 = __DIR__ . '/../../config/sets/symfony/level/deprecated-level-set.php';
}
