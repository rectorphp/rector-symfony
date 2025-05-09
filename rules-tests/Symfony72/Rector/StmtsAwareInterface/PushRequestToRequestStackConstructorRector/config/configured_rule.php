<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(PushRequestToRequestStackConstructorRector::class);
};
