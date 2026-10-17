<?php

namespace Rector\Symfony\Tests\Yaml\Rector\StaticCall\YamlFlagsToConstantRector\Fixture;

use Symfony\Component\Yaml\Yaml;

final class DumpFlags
{
    public function run(array $data)
    {
        $object = Yaml::dump($data, 2, 4, false, true);
        $exception = Yaml::dump($data, 2, 4, true);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Yaml\Rector\StaticCall\YamlFlagsToConstantRector\Fixture;

use Symfony\Component\Yaml\Yaml;

final class DumpFlags
{
    public function run(array $data)
    {
        $object = Yaml::dump($data, 2, 4, \Symfony\Component\Yaml\Yaml::DUMP_OBJECT);
        $exception = Yaml::dump($data, 2, 4, \Symfony\Component\Yaml\Yaml::DUMP_EXCEPTION_ON_INVALID_TYPE);
    }
}

?>
