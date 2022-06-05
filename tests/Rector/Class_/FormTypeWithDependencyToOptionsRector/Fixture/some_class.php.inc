<?php

namespace Rector\Symfony\Tests\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FormTypeWithDependency extends AbstractType
{
    private Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->agent) {
            $builder->add('agent', TextType::class);
        }
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FormTypeWithDependency extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $agent = $options['agent'];

        if ($agent) {
            $builder->add('agent', TextType::class);
        }
    }
}

?>
