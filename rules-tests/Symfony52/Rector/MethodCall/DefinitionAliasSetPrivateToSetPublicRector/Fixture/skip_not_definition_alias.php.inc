<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\MethodCall\DefinitionAliasSetPrivateToSetPublicRector\Fixture;

class SkipNotDefinitionAlias
{
    public function run()
    {
        $d = new \DateTime('now');
        $d->format('Y-m-d');
    }
}
