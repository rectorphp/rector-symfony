<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony42\Rector\New_\RootNodeTreeBuilderRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RootNodeTreeBuilderRector::class);
};
