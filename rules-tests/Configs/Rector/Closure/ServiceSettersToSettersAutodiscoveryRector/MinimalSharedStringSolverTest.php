<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Configs\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rector\Symfony\MinimalSharedStringSolver;

/**
 * Copied from https://github.com/Triun/PHP-Longest-Common-Substring/blob/master/test/suite/SolverTest.php
 */
final class MinimalSharedStringSolverTest extends TestCase
{
    private static MinimalSharedStringSolver $minimalSharedStringSolver;

    public static function setUpBeforeClass(): void
    {
        self::$minimalSharedStringSolver = new MinimalSharedStringSolver();
    }

    #[DataProvider('twoStringsSymmetricValuesProvider')]
    public function testTwoStringsSymmetric(string $stringLeft, string $stringRight, string $expected): void
    {
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringLeft, $stringRight));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringRight, $stringLeft));
    }

    #[DataProvider('twoStringsOrderedValuesProvider')]
    public function testTwoStringsOrdered(string $stringLeft, string $stringRight, string $expected): void
    {
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringLeft, $stringRight));
    }

    #[DataProvider('threeStringsSymmetricValuesProvider')]
    public function testThreeStringsSymmetric(string $stringA, string $stringB, string $stringC, string $expected): void
    {
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringA, $stringB, $stringC));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringA, $stringC, $stringB));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringB, $stringA, $stringC));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringB, $stringC, $stringA));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringC, $stringA, $stringB));
        $this->assertSame($expected, self::$minimalSharedStringSolver->solve($stringC, $stringB, $stringA));
    }

    /**
     * @return Iterator<string, list<string>>
     */
    public static function twoStringsSymmetricValuesProvider(): Iterator
    {
        yield 'Empty values' => ['', '', ''];
        yield 'All elements equal' => ['ABC', 'ABC', 'ABC'];
        yield 'Second string is a substring of first' => ['ABCDEF', 'BCDE', 'BCDE'];
        yield 'Basic common substring' => ['ABDE', 'ACDF', 'A'];
        yield 'Common substring of larger data set' => ['ABCDEF', 'JADFAFKDFBCDEHJDFG', 'BCDE'];
        yield 'Single element substring at start' => ['ABCDEF', 'A', 'A'];
        yield 'Single element substring at middle' => ['ABCDEF', 'D', 'D'];
        yield 'Single element substring at end' => ['ABCDEF', 'F', 'F'];
        yield 'Elements after end of first string' => ['JAFAFKDBCEHJDF', 'JDFAKDFCDEJDFG', 'JDF'];
        yield 'No common elements' => ['ABC', 'DEF', ''];
        yield 'No case common elements' => ['ABC', 'abc', ''];
        yield 'Equal Word' => ['Tortor', 'Tortor', 'Tortor'];
        yield 'Similar Word' => ['Color', 'Colour', 'Colo'];
        yield 'Word case' => ['color', 'Colour', 'olo'];
        yield 'Equal Sentence' => [
            'Donec ullamcorper nulla non metus auctor fringilla.',
            'Donec ullamcorper nulla non metus auctor fringilla.',
            'Donec ullamcorper nulla non metus auctor fringilla.',
        ];
        yield 'Similar Sentence' => [
            'Donec ullamcorper nulla non metus auctor fringilla.',
            'Donec ullamcorper nulla no metus auctor fringilla.',
            'Donec ullamcorper nulla no',
        ];
        yield 'Hexadecimal' => [
            '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
            '23415A32443FC243D123456789AC342553',
            '123456789A',
        ];
        yield 'README example' => ['BANANA', 'ATANA', 'ANA'];
    }

    /**
     * @return Iterator<string, list<string>>
     */
    public static function twoStringsOrderedValuesProvider(): Iterator
    {
        yield 'Reverse string ASC -> DESC' => ['ABCDE', 'EDCBA', 'A'];
        yield 'Reverse string DESC -> ASC' => ['EDCBA', 'ABCDE', 'E'];
        yield 'Order change Natural -> Changed' => ['ABCDEF', 'ABDCEF', 'AB'];
        yield 'Order change Changed -> Natural' => ['ABDCEF', 'ABCDEF', 'AB'];
        yield 'Hexadecimal' => [
            '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
            '56789AB56789ABCDE56789ABCDE56789AB56789A123456789A',
            '123456789A',
        ];
        yield 'Hexadecimal Reverse' => [
            '56789AB56789ABCDE56789ABCDE56789AB56789A123456789A',
            '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
            '56789ABCDE',
        ];
    }

    /**
     * @return Iterator<string, list<string>>
     */
    public static function threeStringsSymmetricValuesProvider(): Iterator
    {
        yield 'No match' => ['ABDEGH', 'JKLMN', 'OPQRST', ''];
        yield 'One match' => ['ABDEGH3', 'JKL3MN', '3OPQRST', '3'];
        yield 'Wikipedia Example' => ['ABABC', 'BABCA', 'ABCBA', 'ABC'];
    }
}
