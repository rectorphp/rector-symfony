<?php

declare(strict_types=1);

namespace Rector\Symfony\Set;

/**
 * @deprecated Set list are too generic and do not handle package differences. Use ->withComposerBased(symfony: true) instead
 *
 * @api
 */
final class SymfonySetList
{
    /**
     * @var string
     */
    final public const CONFIGS = __DIR__ . '/../../config/sets/symfony/configs.php';

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
    final public const SYMFONY_30 = __DIR__ . '/../../config/sets/symfony/symfony3/symfony30.php';

    /**
     * @var string
     */
    final public const SYMFONY_31 = __DIR__ . '/../../config/sets/symfony/symfony3/symfony31.php';

    /**
     * @var string
     */
    final public const SYMFONY_32 = __DIR__ . '/../../config/sets/symfony/symfony3/symfony32.php';

    /**
     * @var string
     */
    final public const SYMFONY_33 = __DIR__ . '/../../config/sets/symfony/symfony3/symfony33.php';

    /**
     * @var string
     */
    final public const SYMFONY_34 = __DIR__ . '/../../config/sets/symfony/symfony3/symfony34.php';

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
     * @deprecated Use ->withAttributesSets(symfony: true) in rector.php config instead
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
    final public const SYMFONY_61 = __DIR__ . '/../../config/sets/symfony/symfony61.php';

    /**
     * @var string
     */
    final public const SYMFONY_62 = __DIR__ . '/../../config/sets/symfony/symfony62.php';

    /**
     * @var string
     */
    final public const SYMFONY_63 = __DIR__ . '/../../config/sets/symfony/symfony63.php';

    /**
     * @var string
     */
    final public const SYMFONY_64 = __DIR__ . '/../../config/sets/symfony/symfony64.php';

    /**
     * @var string
     */
    final public const SYMFONY_70 = __DIR__ . '/../../config/sets/symfony/symfony70.php';

    /**
     * @var string
     */
    final public const SYMFONY_71 = __DIR__ . '/../../config/sets/symfony/symfony71.php';

    /**
     * @var string
     */
    final public const SYMFONY_72 = __DIR__ . '/../../config/sets/symfony/symfony72.php';

    /**
     * @var string
     */
    final public const SYMFONY_73 = __DIR__ . '/../../config/sets/symfony/symfony73.php';

    /**
     * @var string
     */
    final public const SYMFONY_CODE_QUALITY = __DIR__ . '/../../config/sets/symfony/symfony-code-quality.php';

    /**
     * @var string
     */
    final public const SYMFONY_CONSTRUCTOR_INJECTION = __DIR__ . '/../../config/sets/symfony/symfony-constructor-injection.php';

    /**
     * @deprecated Use ->withAttributesSets(symfony: true) in rector.php config instead
     * @var string
     */
    final public const ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/symfony/annotations-to-attributes.php';
}
