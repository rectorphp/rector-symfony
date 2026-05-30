<?php

declare(strict_types=1);

namespace Rector\Symfony\Utils\PHPStan\Tests;

use Iterator;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Symfony\Utils\PHPStan\RequireParentSetConfigImportRule;

/**
 * @extends RuleTestCase<RequireParentSetConfigImportRule>
 */
final class RequireParentSetConfigImportRuleTest extends RuleTestCase
{
    /**
     * @param list<array{0: string, 1: int}> $expectedErrorMessagesWithLines
     */
    #[DataProvider('provideData')]
    public function test(string $filePath, array $expectedErrorMessagesWithLines): void
    {
        $this->analyse([$filePath], $expectedErrorMessagesWithLines);
    }

    /**
     * @return Iterator<array<array<int, mixed>, mixed>>
     */
    public static function provideData(): Iterator
    {
        yield 'all nested configs imported' => [__DIR__ . '/Fixture/config/sets/complete_set.php', []];

        yield 'missing nested config import' => [__DIR__ . '/Fixture/config/sets/incomplete_set.php', [
            ['Config file "second_rule.php" must be imported in parent set config "incomplete_set.php"', 8],
        ]];
    }

    protected function getRule(): Rule
    {
        return new RequireParentSetConfigImportRule();
    }
}
