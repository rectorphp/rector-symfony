<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

class WithSprintf
{
    public function run()
    {
        $process = new Process(sprintf('"%s" -l "%s"', $this->executable, $path));
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony42\Rector\New_\StringToArrayArgumentProcessRector\Fixture;

use Symfony\Component\Process\Process;

class WithSprintf
{
    public function run()
    {
        $process = new Process([$this->executable, '-l', $path]);
    }
}

?>
