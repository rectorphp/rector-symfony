<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;

trait SomeTrait
{
    private $service;

    public function getService()
    {
        return $this->service;
    }

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;

trait SomeTrait
{
    private $service;

    public function getService(): stdClass
    {
        return $this->service;
    }

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }
}

?>
