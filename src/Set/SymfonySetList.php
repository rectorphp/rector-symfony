<?php

declare(strict_types=1);

namespace Rector\Symfony\Set;

/**
 * @api
 */
final class SymfonySetList
{
    public const string CONFIGS = __DIR__ . '/../../config/sets/symfony/configs.php';

    /**
     * Rules bound to the exact Symfony package version they are available from
     */
    public const string COMPOSER_BASED = __DIR__ . '/../../config/sets/symfony/composer-based.php';

    public const string SYMFONY_CODE_QUALITY = __DIR__ . '/../../config/sets/symfony/symfony-code-quality.php';

    public const string SYMFONY_CONSTRUCTOR_INJECTION = __DIR__ . '/../../config/sets/symfony/symfony-constructor-injection.php';

    /**
     * @deprecated Use ->withAttributesSets(symfony: true) in rector.php config instead
     */
    public const string ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/symfony/annotations-to-attributes.php';
}
