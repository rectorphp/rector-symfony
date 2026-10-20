<?php

namespace Rector\Symfony\Tests\Symfony82\Rector\MethodCall\ScheduleWithToAddRector\Fixture;

final class SomeCollection
{
    public function with($item): self
    {
        return $this;
    }
}

final class SkipOtherWith
{
    public function run(SomeCollection $someCollection, $item): SomeCollection
    {
        return $someCollection->with($item);
    }
}
