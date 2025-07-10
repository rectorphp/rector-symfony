<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class NestedConstraintForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foo', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'constraints' => [
                    new Count(['min' => 3, 'max' => 30]),
                    new All([
                        new Length([
                            'min' => 2,
                            'max' => 50,
                            'minMessage' => 'Your foo must be at least {{ limit }} characters long',
                            'maxMessage' => 'Your foo cannot be longer than {{ limit }} characters',
                        ]),
                        new NotBlank(['allowNull' => false]),
                        new Regex([
                            'pattern' => '/\d/',
                            'message' => 'Your foo cannot contain a number',
                            'match' => false,
                        ]),
                    ]),
                ],
            ])
            ->add('bar', CollectionType::class, [
                'entry_type' => IntegerType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'constraints' => new AtLeastOneOf([
                    new All([new LessThanOrEqual(10), new GreaterThanOrEqual(5)]),
                    new All(new EqualTo(value: 50)),
                    new All(new DivisibleBy(0.25)),
                ]),
            ]);
    }
}
?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony73\Rector\Class_\ConstraintOptionsToNamedArgumentsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class NestedConstraintForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foo', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'constraints' => [
                    new Count(min: 3, max: 30),
                    new All([
                        new Length(
                            min: 2,
                            max: 50,
                            minMessage: 'Your foo must be at least {{ limit }} characters long',
                            maxMessage: 'Your foo cannot be longer than {{ limit }} characters',
                        ),
                        new NotBlank(allowNull: false),
                        new Regex(pattern: '/\d/', message: 'Your foo cannot contain a number', match: false),
                    ]),
                ],
            ])
            ->add('bar', CollectionType::class, [
                'entry_type' => IntegerType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'constraints' => new AtLeastOneOf([
                    new All([new LessThanOrEqual(10), new GreaterThanOrEqual(5)]),
                    new All(new EqualTo(value: 50)),
                    new All(new DivisibleBy(0.25)),
                ]),
            ]);
    }
}
?>
