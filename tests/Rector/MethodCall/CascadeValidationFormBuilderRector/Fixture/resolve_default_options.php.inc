<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\CascadeValidationFormBuilderRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ResolveDefaultOptions extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'cascade_validation' => true,
        ]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\MethodCall\CascadeValidationFormBuilderRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ResolveDefaultOptions extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [new \Symfony\Component\Validator\Constraints\Valid()],
        ]);
    }
}

?>
