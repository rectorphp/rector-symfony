<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony73\Rector\New_\RegexToSlugConstraintRector;

return static function (RectorConfig $rectorConfig): void {
    // @see https://symfony.com/blog/new-in-symfony-7-3-slug-and-twig-constraints#slug-constraint
    $rectorConfig->rule(RegexToSlugConstraintRector::class);
};
