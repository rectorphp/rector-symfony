<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

// @see https://github.com/symfony/symfony/blame/7.2/UPGRADE-7.2.md

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/symfony72/symfony72-serializer.php');
};
