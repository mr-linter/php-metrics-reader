<?php

namespace MrLinter\Metrics\Reader;

use MrLinter\Contracts\Metrics\Subject;

class MetricTitleRenderer
{
    /**
     * @param array<string, string> $labels
     */
    public function render(Subject $subject, array $labels): string
    {
        $keys = [];
        $values = [];

        foreach ($labels as $key => $value) {
            $keys[] = sprintf(':%s:', $key);
            $values[] = $value;
        }

        return str_replace($keys, $values, $subject->title);
    }
}
