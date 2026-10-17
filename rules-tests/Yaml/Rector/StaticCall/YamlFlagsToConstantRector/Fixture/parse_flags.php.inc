<?php

namespace Rector\Symfony\Tests\Yaml\Rector\StaticCall\YamlFlagsToConstantRector\Fixture;

use Symfony\Component\Yaml\Yaml;

final class ParseFlags
{
    public function run(string $yaml)
    {
        $objectForMap = Yaml::parse($yaml, false, false, true);
        $object = Yaml::parse($yaml, false, true);
        $exception = Yaml::parse($yaml, true);
        $none = Yaml::parse($yaml, false);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Yaml\Rector\StaticCall\YamlFlagsToConstantRector\Fixture;

use Symfony\Component\Yaml\Yaml;

final class ParseFlags
{
    public function run(string $yaml)
    {
        $objectForMap = Yaml::parse($yaml, \Symfony\Component\Yaml\Yaml::PARSE_OBJECT_FOR_MAP);
        $object = Yaml::parse($yaml, \Symfony\Component\Yaml\Yaml::PARSE_OBJECT);
        $exception = Yaml::parse($yaml, \Symfony\Component\Yaml\Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE);
        $none = Yaml::parse($yaml, 0);
    }
}

?>
