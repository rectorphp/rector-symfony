<?php

namespace Rector\Symfony\Tests\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SkipNoCtorParams extends AbstractType
{
    private int $badgeId;

    public function __construct()
    {
        $this->badgeId = 1000;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->badgeId) {
            $builder->add('agent', TextType::class);
        }
    }
}
