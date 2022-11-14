<?php

declare(strict_types=1);

namespace Symfony\Component\Form;

if (class_exists('Symfony\Component\Form\FormFactory')) {
    return;
}

class FormFactory implements FormFactoryInterface
{

}
