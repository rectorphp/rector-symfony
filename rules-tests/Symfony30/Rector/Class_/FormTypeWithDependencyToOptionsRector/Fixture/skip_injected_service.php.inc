<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\Class_\FormTypeWithDependencyToOptionsRector\Fixture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Routing\RouterInterface;

final class SkipInjectedService extends AbstractType
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (!$this->router->getRouteCollection()) {
            $builder->add('agent', TextType::class);
        }
    }
}
