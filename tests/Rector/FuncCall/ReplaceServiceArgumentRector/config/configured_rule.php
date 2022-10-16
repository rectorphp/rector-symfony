<?php

declare(strict_types=1);

use PhpParser\Node\Scalar\String_;

use Psr\Container\ContainerInterface;

use Rector\Config\RectorConfig;
use Rector\Symfony\Rector\FuncCall\ReplaceServiceArgumentRector;
use Rector\Symfony\ValueObject\ReplaceServiceArgument;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');
    $rectorConfig->ruleWithConfiguration(
        ReplaceServiceArgumentRector::class,
        [new ReplaceServiceArgument(ContainerInterface::class, new String_('service_container'))]
    );
};
