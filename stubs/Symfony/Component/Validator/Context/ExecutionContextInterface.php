<?php

declare(strict_types=1);

namespace Symfony\Component\Validator\Context;

if (class_exists('Symfony\Component\Validator\Context\ExecutionContextInterface')) {
    return;
}

interface ExecutionContextInterface
{
}