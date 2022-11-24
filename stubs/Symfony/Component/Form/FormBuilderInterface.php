<?php

declare(strict_types=1);

namespace Symfony\Component\Form;

if (interface_exists('Symfony\Component\Form\FormBuilderInterface')) {
    return;
}

interface FormBuilderInterface
{
    /**
     * Creates the form.
     *
     * @return FormInterface
     */
    public function getForm();
}
