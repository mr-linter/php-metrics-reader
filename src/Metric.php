<?php

namespace MrLinter\Metrics\Reader;

/**
 * @codeCoverageIgnore
 */
readonly class Metric
{
    public function __construct(
        public string $category,
        public string $title,
        public string $value,
    ) {
    }
}
