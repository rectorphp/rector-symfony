<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\NodeFactory\Annotations;

use Generator;
use PHPUnit\Framework\TestCase;
use Rector\BetterPhpDocParser\ValueObject\PhpDoc\DoctrineAnnotation\CurlyListNode;
use Rector\Symfony\NodeFactory\Annotations\ValueQuoteWrapper;
use stdClass;

class ValueQuoteWrapperTest extends TestCase
{
    /**
     * @dataProvider provideValues
     */
    public function testQuotingValues(mixed $expectedWrappedValue, mixed $value): void
    {
        $valueQuoteWrapper = new ValueQuoteWrapper();

        $this->assertEquals($expectedWrappedValue, $valueQuoteWrapper->wrap($value));
    }

    /**
     * @return Generator<string, mixed>
     */
    public function provideValues(): iterable
    {
        yield 'Quote string' => ['"foo"', 'foo'];
        yield 'Do nothing with integer' => [5, 5];
        yield 'Do nothing with stdClass' => [new stdClass(), new stdClass()];
        yield 'Quote strings in array and return CurlyListNode' => [
            new CurlyListNode(['"foo"', '"bar"']),
            ['foo', 'bar'],
        ];
        yield 'Do nothing with integer in array and return CurlyListNode' => [new CurlyListNode([7, 9]), [7, 9]];
        yield 'Quote strings and ignore integer in array and return CurlyListNode' => [
            new CurlyListNode(['"foo"', 790, '"bar"']),
            ['foo', 790, 'bar'],
        ];
        yield 'Quote string keys and return CurlyListNode' => [
            new CurlyListNode([
                '"fooKey"' => '"foo"',
                790,
                '"barKey"' => '"bar"',
            ]),
            [
                'fooKey' => 'foo',
                790,
                'barKey' => 'bar',
            ],
        ];
    }
}
