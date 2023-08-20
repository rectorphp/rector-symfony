<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

use Symfony\Component\Form\AbstractType;

class ÄxType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'äx';
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\Fixture;

use Symfony\Component\Form\AbstractType;

class ÄxType extends AbstractType
{
}

?>
