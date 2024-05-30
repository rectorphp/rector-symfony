<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MessageIdController extends AbstractController
{

    public function someAction()
    {
        return (new \Swift_Message())->getId();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\SwiftMailer\Rector\ClassMethod\SwiftMessageToEmailRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MessageIdController extends AbstractController
{

    public function someAction()
    {
        return (new \Symfony\Component\Mime\Email())->getHeaders()->get('Content-ID');
    }
}

?>
