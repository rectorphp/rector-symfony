<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\AgentRequiringFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariableWithConstructor extends Controller
{
    public function action()
    {
        $agent = '007';

        $someType = new AgentRequiringFormType($agent);
        $form = $this->createForm($someType);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class CreateFormVariableWithConstructor extends Controller
{
    public function action()
    {
        $agent = '007';

        $form = $this->createForm(\Rector\Symfony\Tests\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source\AgentRequiringFormType::class, null, [
            'agent' => $agent
        ]);
    }
}

?>
