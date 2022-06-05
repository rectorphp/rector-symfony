<?php

declare(strict_types=1);

use Tracy\Debugger;

require __DIR__ . '/../vendor/autoload.php';

// to make dumps readable
Debugger::$maxDepth = 2;

// autoload rector first, but with local paths
// build preload file to autoload local php-parser instead of phpstan one, e.g. in case of early upgrade
exec('php vendor/rector/rector-src/build/build-preload.php .');
usleep(200);

require __DIR__ . '/../preload.php';

unlink(__DIR__ . '/../preload.php');
