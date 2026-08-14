<?php

namespace Bar;

use Symfony\Component\Form\DataMapperInterface;
use Traversable;

class Foo implements DataMapperInterface
{
    public function mapDataToForms($viewData, Traversable $forms): void
    {
    }

    public function mapFormsToData(Traversable $forms, &$viewData): void
    {
    }
}
