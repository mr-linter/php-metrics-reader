<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class WhenCategory implements Filter
{
    public function __construct(
        private readonly string $category,
    ) {
    }

    public function filter(Subject $subject): bool
    {
        return $subject->category === $this->category;
    }
}
