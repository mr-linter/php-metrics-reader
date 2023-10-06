<?php

namespace MrLinter\Metrics\Reader\Filter;

abstract class Composite implements Filter
{
    /**
     * @param iterable<Filter> $filters
     */
    public function __construct(
        protected readonly iterable $filters,
    ) {
    }
}
