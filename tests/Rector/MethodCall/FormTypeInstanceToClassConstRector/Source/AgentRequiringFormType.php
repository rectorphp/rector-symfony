<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\Requirements\Agent;
use Symfony\Component\Form\AbstractType;

final class AgentRequiringFormType extends AbstractType
{
    public function __construct(Agent $agent)
    {
    }
}
