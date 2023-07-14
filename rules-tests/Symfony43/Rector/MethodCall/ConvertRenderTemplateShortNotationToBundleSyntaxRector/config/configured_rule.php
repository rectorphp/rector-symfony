<?php

declare(strict_types=1);
use Rector\Symfony\Tests\ConfigList;

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony43\Rector\MethodCall\ConvertRenderTemplateShortNotationToBundleSyntaxRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->rule(ConvertRenderTemplateShortNotationToBundleSyntaxRector::class);
};
