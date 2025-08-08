<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Output\ConsoleOutput;

function stringToArgumentArray2()
{
    $processHelper = new ProcessHelper();
    $output = new ConsoleOutput();

    $processHelper->run($output, 'ls -l');
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Output\ConsoleOutput;

function stringToArgumentArray2()
{
    $processHelper = new ProcessHelper();
    $output = new ConsoleOutput();

    $processHelper->run($output, ['ls', '-l']);
}

?>
