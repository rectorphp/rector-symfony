<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\NodeAnalyzer\ValidatorAssert;

use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\ParserFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rector\Symfony\NodeAnalyzer\ValidatorAssert\ConstantExpressionAnalyzer;

final class ConstantExpressionAnalyzerTest extends TestCase
{
    private ConstantExpressionAnalyzer $constantExpressionAnalyzer;

    protected function setUp(): void
    {
        $this->constantExpressionAnalyzer = new ConstantExpressionAnalyzer();
    }

    #[DataProvider('provideData')]
    public function test(string $newExpression, bool $expectedAreArgsConstant): void
    {
        $new = $this->parseNew($newExpression);

        $this->assertSame($expectedAreArgsConstant, $this->constantExpressionAnalyzer->areArgsConstant($new->args));
    }

    /**
     * @return iterable<array{string, bool}>
     */
    public static function provideData(): iterable
    {
        yield ['new NotBlank()', true];
        yield ["new NotBlank(message: 'City is empty')", true];
        yield ["new Choice(['choices' => ['first', 'second']])", true];
        yield ['new Choice(choices: SomeClass::CHOICES)', true];
        yield ['new All(new NotBlank())', true];
        yield ['new Length(min: 1 + 2)', true];
        yield ['new Length(min: -1)', true];
        yield ["new Regex('#' . self::PATTERN . '#')", true];

        yield ['new Choice(choices: (new TypeList())->getChoices())', false];
        yield ['new Choice(choices: TypeList::provideChoices())', false];
        yield ['new Choice(choices: array_keys(self::CHOICES))', false];
        yield ['new Callback(function () {})', false];
        yield ['new Callback(fn () => true)', false];
        yield ["new Choice(['choices' => \$choices])", false];
        yield ['new All(new Choice(choices: TypeList::provideChoices()))', false];
    }

    private function parseNew(string $newExpression): New_
    {
        $parser = (new ParserFactory())->createForNewestSupportedVersion();

        $stmts = $parser->parse('<?php ' . $newExpression . ';');
        $this->assertIsArray($stmts);

        $expression = $stmts[0] ?? null;
        $this->assertInstanceOf(Expression::class, $expression);
        $this->assertInstanceOf(New_::class, $expression->expr);

        return $expression->expr;
    }
}
