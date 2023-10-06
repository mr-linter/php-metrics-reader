<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class Callback implements Filter
{
    /**
     * @param \Closure(Subject): bool $filter
     */
    public function __construct(
        private readonly \Closure $filter,
    ) {
    }

    public function filter(Subject $subject): bool
    {
        return ($this->filter)($subject);
    }
}
