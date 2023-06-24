<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;

class FailWithMissingBuildForm extends AbstractType
{
    public function __construct(private Agent $agent)
    {
    }
}

?>
