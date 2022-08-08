<?php

declare(strict_types=1);

namespace Rector\Symfony\Set;

use Rector\Set\Contract\SetListInterface;

final class SymfonySetList implements SetListInterface
{
    /**
     * @var string
     */
    final public const SYMFONY_STRICT = __DIR__ . '/../../config/sets/symfony/symfony-strict.php';

    /**
     * @var string
     */
    final public const SYMFONY_25 = __DIR__ . '/../../config/sets/symfony/symfony25.php';

    /**
     * @var string
     */
    final public const SYMFONY_26 = __DIR__ . '/../../config/sets/symfony/symfony26.php';

    /**
     * @var string
     */
    final public const SYMFONY_27 = __DIR__ . '/../../config/sets/symfony/symfony27.php';

    /**
     * @var string
     */
    final public const SYMFONY_28 = __DIR__ . '/../../config/sets/symfony/symfony28.php';

    /**
     * @var string
     */
    final public const SYMFONY_30 = __DIR__ . '/../../config/sets/symfony/symfony30.php';

    /**
     * @var string
     */
    final public const SYMFONY_31 = __DIR__ . '/../../config/sets/symfony/symfony31.php';

    /**
     * @var string
     */
    final public const SYMFONY_32 = __DIR__ . '/../../config/sets/symfony/symfony32.php';

    /**
     * @var string
     */
    final public const SYMFONY_33 = __DIR__ . '/../../config/sets/symfony/symfony33.php';

    /**
     * @var string
     */
    final public const SYMFONY_34 = __DIR__ . '/../../config/sets/symfony/symfony34.php';

    /**
     * @var string
     */
    final public const SYMFONY_40 = __DIR__ . '/../../config/sets/symfony/symfony40.php';

    /**
     * @var string
     */
    final public const SYMFONY_41 = __DIR__ . '/../../config/sets/symfony/symfony41.php';

    /**
     * @var string
     */
    final public const SYMFONY_42 = __DIR__ . '/../../config/sets/symfony/symfony42.php';

    /**
     * @var string
     */
    final public const SYMFONY_43 = __DIR__ . '/../../config/sets/symfony/symfony43.php';

    /**
     * @var string
     */
    final public const SYMFONY_44 = __DIR__ . '/../../config/sets/symfony/symfony44.php';

    /**
     * @var string
     */
    final public const SYMFONY_50 = __DIR__ . '/../../config/sets/symfony/symfony50.php';

    /**
     * @var string
     */
    final public const SYMFONY_50_TYPES = __DIR__ . '/../../config/sets/symfony/symfony50-types.php';

    /**
     * @var string
     */
    final public const SYMFONY_51 = __DIR__ . '/../../config/sets/symfony/symfony51.php';

    /**
     * @var string
     */
    final public const SYMFONY_52 = __DIR__ . '/../../config/sets/symfony/symfony52.php';

    /**
     * @var string
     */
    final public const SYMFONY_53 = __DIR__ . '/../../config/sets/symfony/symfony53.php';

    /**
     * @var string
     */
    final public const SYMFONY_54 = __DIR__ . '/../../config/sets/symfony/symfony54.php';

    /**
     * @var string
     */
    final public const SYMFONY_52_VALIDATOR_ATTRIBUTES = __DIR__ . '/../../config/sets/symfony/symfony52-validator-attributes.php';

    /**
     * @var string
     */
    final public const SYMFONY_60 = __DIR__ . '/../../config/sets/symfony/symfony60.php';

    /**
     * @var string
     */
    final public const SYMFONY_CODE_QUALITY = __DIR__ . '/../../config/sets/symfony/symfony-code-quality.php';

    /**
     * @var string
     */
    final public const SYMFONY_CONSTRUCTOR_INJECTION = __DIR__ . '/../../config/sets/symfony/symfony-constructor-injection.php';

    /**
     * @var string
     */
    final public const ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/symfony/annotations-to-attributes.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_25 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-25.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_26 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-26.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_27 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-27.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_28 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-28.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_30 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-30.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_31 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-31.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_32 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-32.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_33 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-33.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_34 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-34.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_40 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-40.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_41 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-41.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_42 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-42.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_43 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-43.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_44 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-44.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_50 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-50.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_51 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-51.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_52 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-52.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_53 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-53.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_54 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-54.php';

    /**
     * @var string
     */
    final public const UP_TO_SYMFONY_60 = __DIR__ . '/../../config/sets/symfony/level/up-to-symfony-60.php';
}
