<?php

namespace Rector\Symfony\Tests\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

$command = sprintf("FOO=%s", 10);

$process = new Process($command);