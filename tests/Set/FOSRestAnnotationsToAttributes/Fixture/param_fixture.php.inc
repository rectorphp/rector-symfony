<?php

use FOS\RestBundle\Controller\Annotations\FileParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class BarController
{
    /**
     * @QueryParam(name="fooId", nullable=false, requirements="\d+")
     * @QueryParam(name="name", nullable=true, description="Foo Name")
     */
    public function foo()
    {
    }

    /**
     * @RequestParam(name="name", requirements="[a-z]+", description="Foo Name")
     * @FileParam(name="avatar", requirements={"mimeTypes"="image/jpeg", "minWidth"="500"}, image=true)
     */
    public function create()
    {
    }
}

?>
-----
<?php

use FOS\RestBundle\Controller\Annotations\FileParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class BarController
{
    #[QueryParam(name: 'fooId', nullable: false, requirements: '\d+')]
    #[QueryParam(name: 'name', nullable: true, description: 'Foo Name')]
    public function foo()
    {
    }

    #[RequestParam(name: 'name', requirements: '[a-z]+', description: 'Foo Name')]
    #[FileParam(name: 'avatar', requirements: ['mimeTypes' => 'image/jpeg', 'minWidth' => 500], image: true)]
    public function create()
    {
    }
}

?>
