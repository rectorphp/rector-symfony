<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

function doNotConvertToArrayCallSetWorkingDirectory()
{
    $process = new Process('git log --tags --simplify-by-decoration --pretty="format:%ai %d"');
    $process->setWorkingDirectory('/some/other/path');
    $process->addOutput('Test output');
    $process->addErrorOutput('Test output');
    $process->setInput('Test input');
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

function doNotConvertToArrayCallSetWorkingDirectory()
{
    $process = new Process(['git', 'log', '--tags', '--simplify-by-decoration', '--pretty=format:%ai %d']);
    $process->setWorkingDirectory('/some/other/path');
    $process->addOutput('Test output');
    $process->addErrorOutput('Test output');
    $process->setInput('Test input');
}

?>
