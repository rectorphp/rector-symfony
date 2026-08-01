<?php

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\HttpFoundation\Request;

final class VersionBoundRenames
{
    public function run(Helper $helper, Request $request)
    {
        $width = $helper->strlen('some text');
        $contentType = $request->getContentType();

        return [$width, $contentType];
    }
}

?>
-----
<?php

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\HttpFoundation\Request;

final class VersionBoundRenames
{
    public function run(Helper $helper, Request $request)
    {
        $width = $helper->width('some text');
        $contentType = $request->getContentTypeFormat();

        return [$width, $contentType];
    }
}

?>
