<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony52\Rector\MethodCall\DefinitionAliasSetPrivateToSetPublicRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(DefinitionAliasSetPrivateToSetPublicRector::class);
};
