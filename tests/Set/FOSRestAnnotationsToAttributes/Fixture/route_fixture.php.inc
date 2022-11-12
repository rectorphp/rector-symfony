<?php

use FOS\RestBundle\Controller\Annotations\Copy;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Head;
use FOS\RestBundle\Controller\Annotations\Link;
use FOS\RestBundle\Controller\Annotations\Lock;
use FOS\RestBundle\Controller\Annotations\Mkcol;
use FOS\RestBundle\Controller\Annotations\Move;
use FOS\RestBundle\Controller\Annotations\Options;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\PropFind;
use FOS\RestBundle\Controller\Annotations\PropPatch;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Unlink;
use FOS\RestBundle\Controller\Annotations\Unlock;
use FOS\RestBundle\Controller\Annotations\View;

/**
 * @Route("/api/foo")
 */
class BarController
{
    /**
     * @Copy
     */
    public function copy()
    {
    }

    /**
     * @Delete("/delete", name="foo_delete")
     */
    public function delete()
    {
    }

    /**
     * @Get("/list", name="foo_list")
     * @View(serializerEnableMaxDepthChecks=false)
     */
    public function list()
    {
    }

    /**
     * @Head
     */
    public function foo()
    {
    }

    /**
     * @Link
     */
    public function addFriend()
    {
    }

    /**
     * @Lock
     */
    public function pessimisticLock()
    {
    }

    /**
     * @Mkcol
     */
    public function createList()
    {
    }

    /**
     * @Move
     */
    public function move()
    {
    }

    /**
     * @Options
     */
    public function options()
    {
    }

    /**
     * @Patch("/update", name="foo_update")
     */
    public function update()
    {
    }

    /**
     * @Post("/create", name="foo_create")
     */
    public function create()
    {
    }

    /**
     * @PropFind
     */
    public function propFind()
    {
    }

    /**
     * @PropPatch
     */
    public function propPatch()
    {
    }

    /**
     * @Put("/replace", name="foo_replace")
     */
    public function replace()
    {
    }

    /**
     * @Unlink
     */
    public function removeFriend()
    {
    }

    /**
     * @Unlock
     */
    public function unlock()
    {
    }
}

?>
-----
<?php

use FOS\RestBundle\Controller\Annotations\Copy;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Head;
use FOS\RestBundle\Controller\Annotations\Link;
use FOS\RestBundle\Controller\Annotations\Lock;
use FOS\RestBundle\Controller\Annotations\Mkcol;
use FOS\RestBundle\Controller\Annotations\Move;
use FOS\RestBundle\Controller\Annotations\Options;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\PropFind;
use FOS\RestBundle\Controller\Annotations\PropPatch;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\Unlink;
use FOS\RestBundle\Controller\Annotations\Unlock;
use FOS\RestBundle\Controller\Annotations\View;

#[Route('/api/foo')]
class BarController
{
    #[Copy]
    public function copy()
    {
    }

    #[Delete('/delete', name: 'foo_delete')]
    public function delete()
    {
    }

    #[Get('/list', name: 'foo_list')]
    #[View(serializerEnableMaxDepthChecks: false)]
    public function list()
    {
    }

    #[Head]
    public function foo()
    {
    }

    #[Link]
    public function addFriend()
    {
    }

    #[Lock]
    public function pessimisticLock()
    {
    }

    #[Mkcol]
    public function createList()
    {
    }

    #[Move]
    public function move()
    {
    }

    #[Options]
    public function options()
    {
    }

    #[Patch('/update', name: 'foo_update')]
    public function update()
    {
    }

    #[Post('/create', name: 'foo_create')]
    public function create()
    {
    }

    #[PropFind]
    public function propFind()
    {
    }

    #[PropPatch]
    public function propPatch()
    {
    }

    #[Put('/replace', name: 'foo_replace')]
    public function replace()
    {
    }

    #[Unlink]
    public function removeFriend()
    {
    }

    #[Unlock]
    public function unlock()
    {
    }
}

?>
