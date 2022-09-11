<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class BarController
{
    /**
     * @Entity("user", expr="repository.find(user_id)")
     */
    public function foo(User $user)
    {
    }
}

?>
-----
<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class BarController
{
    #[Entity('user', expr: 'repository.find(user_id)')]
    public function foo(User $user)
    {
    }
}

?>
