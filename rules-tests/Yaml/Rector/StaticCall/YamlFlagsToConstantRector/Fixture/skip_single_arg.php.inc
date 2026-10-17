<?php

namespace Rector\Symfony\Tests\Yaml\Rector\StaticCall\YamlFlagsToConstantRector\Fixture;

use Symfony\Component\Yaml\Yaml;

final class SkipSingleArg
{
    public function run(string $yaml)
    {
        return Yaml::parse($yaml);
    }
}
