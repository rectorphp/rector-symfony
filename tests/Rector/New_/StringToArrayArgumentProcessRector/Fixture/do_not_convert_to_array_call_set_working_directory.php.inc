<?php

namespace Rector\Symfony\Tests\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

function doNotConvertToArrayCallSetWorkingDirectory()
{
    $process = new Process('git log --tags --simplify-by-decoration --pretty="format:%ai %d"');
    $process->setWorkingDirectory('/some/other/path');
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

function doNotConvertToArrayCallSetWorkingDirectory()
{
    $process = new Process(['git', 'log', '--tags', '--simplify-by-decoration', '--pretty=format:%ai %d']);
    $process->setWorkingDirectory('/some/other/path');
}

?>
