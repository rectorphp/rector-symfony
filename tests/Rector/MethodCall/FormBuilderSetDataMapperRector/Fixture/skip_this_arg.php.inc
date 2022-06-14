<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;

final class RegistrationFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->setDataMapper($this);
    }

    public function mapDataToForms(mixed $viewData, Traversable $forms)
    {
    }

    public function mapFormsToData(Traversable $forms, mixed &$viewData)
    {
    }
}
