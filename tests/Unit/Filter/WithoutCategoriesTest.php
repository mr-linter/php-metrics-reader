<?php

namespace MrLinter\Metrics\Reader\Tests\Unit\Filter;

use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Filter\WithoutCategories;
use MrLinter\Metrics\Reader\Tests\TestCase;

final class WithoutCategoriesTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\Filter\WithoutCategories::filter
     *
     * @dataProvider providerForTestFilter
     */
    public function testFilter(array $categories, array $subjects, array $expectedStates): void
    {
        $filter = new WithoutCategories($categories);
        $states = [];

        foreach ($subjects as $subject) {
            $states[] = $filter->filter($subject);
        }

        self::assertEquals($expectedStates, $states);
    }

    public static function providerForTestFilter(): array
    {
        return [
            [
                'categories' => ['test1', 'test2'],
                'subjects' => [
                    new Subject('test1', '', ''),
                    new Subject('test2', '', ''),
                    new Subject('test3', '', ''),
                ],
                'expectedStates' => [
                    false,
                    false,
                    true,
                ],
            ],
        ];
    }
}
