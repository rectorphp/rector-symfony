<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class SingleActionWithConstruct extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function create(): Response
    {
        return $this->json([], Response::HTTP_CREATED);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class SingleActionWithConstruct extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function __invoke(): Response
    {
        return $this->json([], Response::HTTP_CREATED);
    }
}

?>
