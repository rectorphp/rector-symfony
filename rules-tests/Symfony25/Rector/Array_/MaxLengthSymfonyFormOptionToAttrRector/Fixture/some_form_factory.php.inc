<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

$formBuilder = new \Symfony\Component\Form\FormFactory();

$form = $formBuilder->create('name', 'text', [
    'max_length' => 123,
]);

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony40\Rector\Array_\MaxLengthSymfonyFormOptionToAttrRector\Fixture;

$formBuilder = new \Symfony\Component\Form\FormFactory();

$form = $formBuilder->create('name', 'text', [
    'attr' => ['maxlength' => 123],
]);

?>
