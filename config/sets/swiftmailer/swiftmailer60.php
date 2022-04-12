<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    $services->set(RenameClassRector::class)
        ->configure([
            # swiftmailer 60
            'Swift_Mime_Message' => 'Swift_Mime_SimpleMessage',
        ]);
};
