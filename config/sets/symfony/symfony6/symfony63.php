<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony63\Rector\Class_\ParamAndEnvAttributeRector;

// @see https://github.com/symfony/symfony/blob/6.3/UPGRADE-6.3.md
// @see \Rector\Symfony\Tests\Set\Symfony63\Symfony63Test
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        // @see https://symfony.com/blog/new-in-symfony-6-3-dependency-injection-improvements#new-options-for-autowire-attribute
        ParamAndEnvAttributeRector::class,
    ]);

    $rectorConfig->import(__DIR__ . '/symfony63/symfony63-dependency-injection.php');
    $rectorConfig->import(__DIR__ . '/symfony63/symfony63-http-client.php');
    $rectorConfig->import(__DIR__ . '/symfony63/symfony63-messenger.php');
    $rectorConfig->import(__DIR__ . '/symfony63/symfony63-console.php');
};
