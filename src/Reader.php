<?php

namespace MrLinter\Metrics\Reader;

use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Filter\Filter;

/**
 * Interface for metrics readers.
 */
interface Reader
{
    /**
     * Read metrics by filter.
     *
     * @return iterable<Metric>
     */
    public function read(Filter $filter): iterable;
}
