<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class Each extends Composite
{
    public function filter(Subject $subject): bool
    {
        foreach ($this->filters as $filter) {
            if (! $filter->filter($subject)) {
                return false;
            }
        }

        return true;
    }
}
