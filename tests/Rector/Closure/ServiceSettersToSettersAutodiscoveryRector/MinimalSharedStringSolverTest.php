<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Closure\ServiceSettersToSettersAutodiscoveryRector;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rector\Symfony\Rector\Closure\MinimalSharedStringSolver;

/**
 * Copied from https://github.com/Triun/PHP-Longest-Common-Substring/blob/master/test/suite/SolverTest.php
 */
class MinimalSharedStringSolverTest extends TestCase
{
    /**
     * @var MinimalSharedStringSolver
     */
    protected static $solver;

    public static function setUpBeforeClass(): void
    {
        static::$solver = new MinimalSharedStringSolver();
    }

    /**
     * @param string $stringLeft
     * @param string $stringRight
     * @param string $expected
     */
    #[DataProvider('twoStringsSymmetricValuesProvider')]
    public function testTwoStringsSymmetric($stringLeft, $stringRight, $expected): void
    {
        $this->assertSame($expected, static::$solver->solve($stringLeft, $stringRight));
        $this->assertSame($expected, static::$solver->solve($stringRight, $stringLeft));
    }

    /**
     * @param string $stringLeft
     * @param string $stringRight
     * @param string $expected
     */
    #[DataProvider('twoStringsOrderedValuesProvider')]
    public function testTwoStringsOrdered($stringLeft, $stringRight, $expected): void
    {
        $this->assertSame($expected, static::$solver->solve($stringLeft, $stringRight));
    }

    /**
     * @param string $stringA
     * @param string $stringB
     * @param string $stringC
     * @param string $expected
     */
    #[DataProvider('threeStringsSymmetricValuesProvider')]
    public function testThreeStringsSymmetric($stringA, $stringB, $stringC, $expected): void
    {
        $this->assertSame($expected, static::$solver->solve($stringA, $stringB, $stringC));
        $this->assertSame($expected, static::$solver->solve($stringA, $stringC, $stringB));
        $this->assertSame($expected, static::$solver->solve($stringB, $stringA, $stringC));
        $this->assertSame($expected, static::$solver->solve($stringB, $stringC, $stringA));
        $this->assertSame($expected, static::$solver->solve($stringC, $stringA, $stringB));
        $this->assertSame($expected, static::$solver->solve($stringC, $stringB, $stringA));
    }

    /**
     * @return array<string, list<string>>
     */
    public static function twoStringsSymmetricValuesProvider(): array
    {
        return [
            'Empty values' => ['', '', ''],
            'All elements equal' => ['ABC', 'ABC', 'ABC'],
            'Second string is a substring of first' => ['ABCDEF', 'BCDE', 'BCDE'],
            'Basic common substring' => ['ABDE', 'ACDF', 'A'],
            'Common substring of larger data set' => ['ABCDEF', 'JADFAFKDFBCDEHJDFG', 'BCDE'],
            'Single element substring at start' => ['ABCDEF', 'A', 'A'],
            'Single element substring at middle' => ['ABCDEF', 'D', 'D'],
            'Single element substring at end' => ['ABCDEF', 'F', 'F'],
            'Elements after end of first string' => ['JAFAFKDBCEHJDF', 'JDFAKDFCDEJDFG', 'JDF'],
            'No common elements' => ['ABC', 'DEF', ''],
            'No case common elements' => ['ABC', 'abc', ''],
            'Equal Word' => ['Tortor', 'Tortor', 'Tortor'],
            'Similar Word' => ['Color', 'Colour', 'Colo'],
            'Word case' => ['color', 'Colour', 'olo'],
            'Equal Sentence' => [
                'Donec ullamcorper nulla non metus auctor fringilla.',
                'Donec ullamcorper nulla non metus auctor fringilla.',
                'Donec ullamcorper nulla non metus auctor fringilla.',
            ],
            'Similar Sentence' => [
                'Donec ullamcorper nulla non metus auctor fringilla.',
                'Donec ullamcorper nulla no metus auctor fringilla.',
                'Donec ullamcorper nulla no',
            ],
            'Hexadecimal' => [
                '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
                '23415A32443FC243D123456789AC342553',
                '123456789A',
            ],
            'README example' => ['BANANA', 'ATANA', 'ANA'],
        ];
    }

    /**
     * @return array<string, list<string>>
     */
    public static function twoStringsOrderedValuesProvider(): array
    {
        return [
            'Reverse string ASC -> DESC' => ['ABCDE', 'EDCBA', 'A'],
            'Reverse string DESC -> ASC' => ['EDCBA', 'ABCDE', 'E'],
            'Order change Natural -> Changed' => ['ABCDEF', 'ABDCEF', 'AB'],
            'Order change Changed -> Natural' => ['ABDCEF', 'ABCDEF', 'AB'],
            'Hexadecimal' => [
                '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
                '56789AB56789ABCDE56789ABCDE56789AB56789A123456789A',
                '123456789A',
            ],
            'Hexadecimal Reverse' => [
                '56789AB56789ABCDE56789ABCDE56789AB56789A123456789A',
                '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF',
                '56789ABCDE',
            ],
        ];
    }

    /**
     * @return array<string, list<string>>
     */
    public static function threeStringsSymmetricValuesProvider(): array
    {
        return [
            'No match' => ['ABDEGH', 'JKLMN', 'OPQRST', ''],
            'One match' => ['ABDEGH3', 'JKL3MN', '3OPQRST', '3'],
            'Wikipedia Example' => ['ABABC', 'BABCA', 'ABCBA', 'ABC'],
        ];
    }
}
