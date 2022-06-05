<?php

namespace Rector\Symfony\Tests\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class RenameOnlyLocalProperties extends AbstractType
{
    private Agent $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $another = $options['another'];

        if ($this->agent) {
            $builder->add('agent', TextType::class);
        }

        if ($another->agent) {
            $builder->add('another_agent', TextType::class);
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

final class RenameOnlyLocalProperties extends AbstractType
{
    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $agent = $options['agent'];
        $another = $options['another'];

        if ($agent) {
            $builder->add('agent', TextType::class);
        }

        if ($another->agent) {
            $builder->add('another_agent', TextType::class);
        }
    }
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults(['agent' => null]);
    }
}

?>
