<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;

trait FlipSetFirst
{
    private $service;

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }

    public function getService()
    {
        return $this->service;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;

trait FlipSetFirst
{
    private $service;

    /**
     * @required
     */
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }

    public function getService(): stdClass
    {
        return $this->service;
    }
}

?>
