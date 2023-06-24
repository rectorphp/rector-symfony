<?php

namespace Rector\Symfony\Tests\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

$formBuilder = new \Symfony\Component\Form\FormFactory();

$form = $formBuilder->create('name', 'text', [
    'max_length' => 123,
    'attrs' => [
        'some' => 'value'
    ],
]);

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

$formBuilder = new \Symfony\Component\Form\FormFactory();

$form = $formBuilder->create('name', 'text', [
    'attrs' => [
        'some' => 'value', 'maxlength' => 123
    ],
]);

?>
