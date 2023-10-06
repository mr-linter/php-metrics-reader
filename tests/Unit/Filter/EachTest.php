<?php

namespace MrLinter\Metrics\Reader\Tests\Unit\Filter;

use MrLinter\Metrics\Reader\Filter\Callback;
use MrLinter\Metrics\Reader\Filter\Each;
use MrLinter\Metrics\Reader\Tests\TestCase;

final class EachTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\Filter\Each::filter
     *
     * @dataProvider providerForTestFilter
     */
    public function testFilter(array $subFilters, bool $expected): void
    {
        $filter = new Each($subFilters);

        self::assertEquals($expected, $filter->filter($this->createEmptyMetricSubject()));
    }

    public static function providerForTestFilter(): array
    {
        return [
            [
                'subFilters' => [],
                'expected' => true,
            ],
            [
                'subFilters' => [
                    new Callback(fn () => false),
                ],
                'expected' => false,
            ],
            [
                'subFilters' => [
                    new Callback(fn () => true),
                    new Callback(fn () => false),
                ],
                'expected' => false,
            ],
            [
                'subFilters' => [
                    new Callback(fn () => true),
                    new Callback(fn () => true),
                ],
                'expected' => true,
            ],
        ];
    }
}
