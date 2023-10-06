<?php

namespace MrLinter\Metrics\Reader;

use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Filter\Filter;

final class SnapshotsReader implements Reader
{
    /**
     * @param iterable<Snapshot> $snapshots
     */
    public function __construct(
        private readonly iterable $snapshots,
        private readonly MetricTitleRenderer $titleRenderer,
    ) {
    }

    public function read(Filter $filter): iterable
    {
        $metrics = [];

        foreach ($this->snapshots as $snapshot) {
            if (! $filter->filter($snapshot->subject)) {
                continue;
            }

            foreach ($snapshot->histograms as $histogram) {
                $values = $histogram->all();
                $lastValue = end($values);

                if ($lastValue === false) {
                    continue;
                }

                $metrics[] = $this->createMetric($snapshot->subject, $histogram->labels(), $lastValue);
            }

            foreach ($snapshot->counters as $counter) {
                $metrics[] = $this->createMetric($snapshot->subject, $counter->labels, $counter->value);
            }

            foreach ($snapshot->gauges as $gauge) {
                $metrics[] = $this->createMetric($snapshot->subject, $gauge->labels, $gauge->value);
            }
        }

        return $metrics;
    }

    private function valueToString(float $value): string
    {
        if ($value % 2 === 0) {
            return "$value.0";
        }

        return "$value";
    }

    /**
     * @param array<string, string> $labels
     */
    private function createMetric(Subject $subject, array $labels, float $value): Metric
    {
        return new Metric(
            $subject->category,
            $this->titleRenderer->render($subject, $labels),
            $this->valueToString($value),
        );
    }
}
