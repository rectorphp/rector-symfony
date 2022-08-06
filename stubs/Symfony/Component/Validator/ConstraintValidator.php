<?php

declare(strict_types=1);

namespace Symfony\Component\Validator;

if (class_exists('Symfony\Component\Validator\ConstraintValidator')) {
    return;
}

abstract class ConstraintValidator
{
    /**
     * @var Context\ExecutionContextInterface
     */
    protected $context;
}
