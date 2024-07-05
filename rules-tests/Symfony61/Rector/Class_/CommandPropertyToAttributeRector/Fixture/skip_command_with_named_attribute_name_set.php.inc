<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine')]
class SkipCommandWithNamedAttributeNameSet extends \Symfony\Component\Console\Command\Command
{
}
