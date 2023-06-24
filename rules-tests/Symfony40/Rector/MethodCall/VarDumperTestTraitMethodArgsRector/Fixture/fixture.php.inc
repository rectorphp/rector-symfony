<?php

use Rector\Symfony\Tests\Symfony40\Rector\MethodCall\VarDumperTestTraitMethodArgsRector\Source\ClassWithVarDumperTrait;

function varDumperTrait()
{
    $trait = new ClassWithVarDumperTrait();
    $trait->assertDumpEquals($dump, $data, 'Custom message');
    $trait->assertDumpMatchesFormat($dump, $data, 'Custom message');
}

?>
-----
<?php

use Rector\Symfony\Tests\Symfony40\Rector\MethodCall\VarDumperTestTraitMethodArgsRector\Source\ClassWithVarDumperTrait;

function varDumperTrait()
{
    $trait = new ClassWithVarDumperTrait();
    $trait->assertDumpEquals($dump, $data, 0, 'Custom message');
    $trait->assertDumpMatchesFormat($dump, $data, 0, 'Custom message');
}

?>
