<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BarController
{
    /**
     * @ParamConverter("user", class="User")
     */
    public function foo(User $user)
    {
    }
}

?>
-----
<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BarController
{
    #[ParamConverter('user', class: 'User')]
    public function foo(User $user)
    {
    }
}

?>
