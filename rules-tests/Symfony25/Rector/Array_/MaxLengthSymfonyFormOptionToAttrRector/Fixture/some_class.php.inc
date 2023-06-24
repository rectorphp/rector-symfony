<?php

namespace Rector\Symfony\Tests\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

use Symfony\Component\Form\FormBuilder;

$formBuilder = new FormBuilder();

$form = $formBuilder->add('name', 'text', [
    'max_length' => 123,
]);

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

use Symfony\Component\Form\FormBuilder;

$formBuilder = new FormBuilder();

$form = $formBuilder->add('name', 'text', [
    'attr' => ['maxlength' => 123],
]);

?>
