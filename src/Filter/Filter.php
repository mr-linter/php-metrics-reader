<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

/**
 * Interface for metrics filters.
 */
interface Filter
{
    /**
     * Filter metrics by subject.
     */
    public function filter(Subject $subject): bool;
}
