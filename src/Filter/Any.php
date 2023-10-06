<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class Any implements Filter
{
    public function filter(Subject $subject): bool
    {
        return true;
    }
}
