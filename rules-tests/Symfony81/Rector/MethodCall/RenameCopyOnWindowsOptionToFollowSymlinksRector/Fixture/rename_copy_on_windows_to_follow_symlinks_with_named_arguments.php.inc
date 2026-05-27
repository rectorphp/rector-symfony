<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\RenameCopyOnWindowsOptionToFollowSymlinksRector\Fixture;

use Symfony\Component\Filesystem\Filesystem;

final class Foo
{
    public function __construct(private Filesystem $filesystem) {}

    public function bar($originDir, $targetDir): void
    {
        $this->filesystem->mirror(targetDir: $originDir, originDir: $targetDir, options: ['copy_on_windows' => true]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony81\Rector\MethodCall\RenameCopyOnWindowsOptionToFollowSymlinksRector\Fixture;

use Symfony\Component\Filesystem\Filesystem;

final class Foo
{
    public function __construct(private Filesystem $filesystem) {}

    public function bar($originDir, $targetDir): void
    {
        $this->filesystem->mirror(targetDir: $originDir, originDir: $targetDir, options: ['follow_symlinks' => true]);
    }
}

?>
