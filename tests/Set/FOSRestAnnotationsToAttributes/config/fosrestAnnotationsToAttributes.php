<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\FOSRestSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([FOSRestSetList::ANNOTATIONS_TO_ATTRIBUTES]);
};
