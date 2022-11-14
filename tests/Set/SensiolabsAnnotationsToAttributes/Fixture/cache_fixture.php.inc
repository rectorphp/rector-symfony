<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * @Cache(expires="tomorrow", public=true)
 */
class BarController
{
    /**
     * @Cache(smaxage="20")
     */
    public function foo()
    {
    }
}

?>
-----
<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

#[Cache(expires: 'tomorrow', public: true)]
class BarController
{
    #[Cache(smaxage: 20)]
    public function foo()
    {
    }
}

?>
