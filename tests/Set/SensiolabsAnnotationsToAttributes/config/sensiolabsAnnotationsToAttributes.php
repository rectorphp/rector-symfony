<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SensiolabsSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([SensiolabsSetList::ANNOTATIONS_TO_ATTRIBUTES]);
};
