<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ActionSuffixNoRoute extends AbstractController
{
    /**
     * Deletes an entity.
     *
     * @param int $id Entity ID
     */
    public function deleteEntityAction($id)
    {
        return $this->redirectToRoute('some_route', ['id' => $id]);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ActionSuffixNoRoute extends AbstractController
{
    /**
     * Deletes an entity.
     *
     * @param int $id Entity ID
     */
    public function deleteEntityAction($id): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return $this->redirectToRoute('some_route', ['id' => $id]);
    }
}

?>
