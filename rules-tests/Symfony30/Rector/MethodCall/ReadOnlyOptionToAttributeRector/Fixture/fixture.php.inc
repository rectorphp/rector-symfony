<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\ReadOnlyOptionToAttributeRector\Fixture;

use Symfony\Component\Form\FormBuilder;

class ReadOnlyOptionToAttribute
{
    function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('cuid', TextType::class, ['read_only' => true]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\ReadOnlyOptionToAttributeRector\Fixture;

use Symfony\Component\Form\FormBuilder;

class ReadOnlyOptionToAttribute
{
    function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('cuid', TextType::class, ['attr' => ['readonly' => true]]);
    }
}

?>
