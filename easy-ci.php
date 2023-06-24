<?php

declare(strict_types=1);

use Rector\Core\Contract\Rector\RectorInterface;
use Rector\Set\Contract\SetListInterface;
use Rector\Symfony\Contract\Bridge\Symfony\Routing\SymfonyRoutesProviderInterface;
use Symplify\EasyCI\Config\EasyCIConfig;

return static function (EasyCIConfig $easyCIConfig): void {
    $easyCIConfig->paths([
         __DIR__ . '/config',
         __DIR__ . '/src',
         __DIR__ . '/rules',
    ]);

    $easyCIConfig->typesToSkip([
        SymfonyRoutesProviderInterface::class,
        SetListInterface::class,
        RectorInterface::class,
    ]);
};
