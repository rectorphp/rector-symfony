<?php

use Symfony\Component\Form\FormBuilderInterface;

trait FormTraitDataMappter
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->setDataMapper($this);
    }
}

