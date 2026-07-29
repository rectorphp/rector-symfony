<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class TwoRequestStacksWithStatementsBetween extends TestCase
{
    public function testThis()
    {
        $requestStack = new RequestStack();
        $requestStack->push(new Request([], [
            'editorState' => ['pages' => []],
        ]));

        $model = $this->getModel($requestStack);
        $this->assertNotNull($model);

        $requestStackNoEditor = new RequestStack();
        $requestStackNoEditor->push(new Request([], [
            'customMjml' => '<mjml/>',
        ]));

        $modelNoEditor = $this->getModel($requestStackNoEditor);
        $this->assertNotNull($modelNoEditor);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony72\Rector\StmtsAwareInterface\PushRequestToRequestStackConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class TwoRequestStacksWithStatementsBetween extends TestCase
{
    public function testThis()
    {
        $requestStack = new RequestStack([new Request([], [
            'editorState' => ['pages' => []],
        ])]);

        $model = $this->getModel($requestStack);
        $this->assertNotNull($model);

        $requestStackNoEditor = new RequestStack([new Request([], [
            'customMjml' => '<mjml/>',
        ])]);

        $modelNoEditor = $this->getModel($requestStackNoEditor);
        $this->assertNotNull($modelNoEditor);
    }
}

?>
