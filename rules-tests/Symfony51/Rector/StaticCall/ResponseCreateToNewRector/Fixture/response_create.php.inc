<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\StaticCall\ResponseCreateToNewRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ResponseCreate
{
    public function run()
    {
        $response = Response::create('content', 200);
        $jsonResponse = JsonResponse::create(['key' => 'value']);
        $redirectResponse = RedirectResponse::create('/home');
        $streamedResponse = StreamedResponse::create();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony51\Rector\StaticCall\ResponseCreateToNewRector\Fixture;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ResponseCreate
{
    public function run()
    {
        $response = new \Symfony\Component\HttpFoundation\Response('content', 200);
        $jsonResponse = new \Symfony\Component\HttpFoundation\JsonResponse(['key' => 'value']);
        $redirectResponse = new \Symfony\Component\HttpFoundation\RedirectResponse('/home');
        $streamedResponse = new \Symfony\Component\HttpFoundation\StreamedResponse();
    }
}

?>
