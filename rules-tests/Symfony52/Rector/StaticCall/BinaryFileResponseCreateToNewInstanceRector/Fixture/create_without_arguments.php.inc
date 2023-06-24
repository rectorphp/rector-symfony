<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\StaticCall\BinaryFileResponseCreateToNewInstanceRector\Fixture;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CreateWithoutArguments
{
    public function action()
    {
        $binaryFileResponse = BinaryFileResponse::create();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony52\Rector\StaticCall\BinaryFileResponseCreateToNewInstanceRector\Fixture;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CreateWithoutArguments
{
    public function action()
    {
        $binaryFileResponse = new BinaryFileResponse(null);
    }
}

?>
