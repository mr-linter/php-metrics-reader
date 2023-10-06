<?php

namespace MrLinter\Metrics\Reader\Tests\Unit\Filter;

use MrLinter\Metrics\Reader\Filter\Any;
use MrLinter\Metrics\Reader\Tests\TestCase;

final class AnyTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\Filter\Any::__invoke
     */
    public function testFilter(): void
    {
        $filter = new Any();

        self::assertTrue($filter->filter($this->createEmptyMetricSubject()));
    }
}
