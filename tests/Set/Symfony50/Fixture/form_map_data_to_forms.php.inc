<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;

class FormTest extends AbstractType implements DataMapperInterface
{

    public function mapDataToForms(mixed $viewData, $forms)
    {

    }

    public function mapFormsToData($forms, mixed &$viewData)
    {

    }
}

?>
-----
<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;

class FormTest extends AbstractType implements DataMapperInterface
{

    public function mapDataToForms(mixed $viewData, iterable $forms)
    {

    }

    public function mapFormsToData(iterable $forms, mixed &$viewData)
    {

    }
}

?>
