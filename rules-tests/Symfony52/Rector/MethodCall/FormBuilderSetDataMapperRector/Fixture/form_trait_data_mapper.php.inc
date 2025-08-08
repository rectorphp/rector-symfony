<?php

use Symfony\Component\Form\FormBuilderInterface;

trait FormTraitDataMapper
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->setDataMapper($this);
    }
}

