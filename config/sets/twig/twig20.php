<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    $services->set(RenameClassRector::class)
        ->configure([
            #filters
            # see https://twig.symfony.com/doc/1.x/deprecated.html
            'Twig_SimpleFilter' => 'Twig_Filter',
            #functions
            # see https://twig.symfony.com/doc/1.x/deprecated.html
            'Twig_SimpleFunction' => 'Twig_Function',
            # see https://github.com/bolt/bolt/pull/6596
            'Twig_SimpleTest' => 'Twig_Test',
        ]);
};
