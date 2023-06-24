<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\AgentRequiringFormType;
use Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\Requirements\Agent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariableWithConstructor extends Controller
{
    public function action()
    {
        $agent = new Agent();

        $someType = new AgentRequiringFormType($agent);
        $form = $this->createForm($someType);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\AgentRequiringFormType;
use Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\Requirements\Agent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariableWithConstructor extends Controller
{
    public function action()
    {
        $agent = new Agent();

        $someType = new AgentRequiringFormType($agent);
        $form = $this->createForm(\Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\AgentRequiringFormType::class, null, ['agent' => $agent]);
    }
}

?>
