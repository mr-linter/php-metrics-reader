<?php

namespace MrLinter\Metrics\Reader;

use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Filter\Filter;

/**
 * @phpstan-type Filter = \Closure(Subject): bool
 */
interface Reader
{
    /**
     * @return iterable<Metric>
     */
    public function read(Filter $filter): iterable;
}
