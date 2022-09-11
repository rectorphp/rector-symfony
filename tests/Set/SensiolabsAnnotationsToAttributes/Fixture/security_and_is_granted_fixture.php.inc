<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BarController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Security("is_granted('ROLE_USER') and is_granted('SHOW_FOO')")
     */
    public function foo()
    {
    }
}

?>
-----
<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BarController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Security("is_granted('ROLE_USER') and is_granted('SHOW_FOO')")]
    public function foo()
    {
    }
}

?>
