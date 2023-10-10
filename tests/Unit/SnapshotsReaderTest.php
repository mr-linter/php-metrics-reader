<?php

namespace MrLinter\Metrics\Reader\Tests\Unit;

use MrLinter\Contracts\Metrics\CalculatedHistogramRecord;
use MrLinter\Contracts\Metrics\CalculatedNumberList;
use MrLinter\Contracts\Metrics\CounterRecord;
use MrLinter\Contracts\Metrics\GaugeRecord;
use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Filter\Callback;
use MrLinter\Metrics\Reader\Metric;
use MrLinter\Metrics\Reader\MetricTitleRenderer;
use MrLinter\Metrics\Reader\SnapshotsReader;
use PHPUnit\Framework\TestCase;

final class SnapshotsReaderTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\SnapshotsReader::read
     *
     * @dataProvider providerForTestRead
     */
    public function testRead(iterable $snapshots, callable $filter, iterable $metrics): void
    {
        $reader = new SnapshotsReader(
            $snapshots,
            new MetricTitleRenderer(),
        );

        self::assertEquals($metrics, $reader->read(new Callback($filter)));
    }

    public static function providerForTestRead(): array
    {
        return [
            [
                'snapshots' => [],
                'filter' => fn () => true,
                'metrics' => [],
            ],
            [
                'snapshots' => [],
                'filter' => fn () => false,
                'metrics' => [],
            ],
            [
                'snapshots' => [
                    new Snapshot(
                        new Subject('http', 'requests_total', 'http requests total'),
                        [
                            new CounterRecord(5, []),
                        ],
                        [],
                        [],
                    ),
                ],
                'filter' => fn () => true,
                'metrics' => [
                    new Metric(
                        'http',
                        'http requests total',
                        5,
                    ),
                ],
            ],
            [
                'snapshots' => [
                    new Snapshot(
                        new Subject('http', 'requests_total', 'http requests total'),
                        [
                            new CounterRecord(5, []),
                        ],
                        [],
                        [],
                    ),
                ],
                'filter' => fn () => false,
                'metrics' => [],
            ],
            [
                'snapshots' => [
                    new Snapshot(
                        new Subject('http', 'requests_total', 'http requests total :host:'),
                        [
                            new CounterRecord(5, [
                                'host' => 'site.com',
                            ]),
                        ],
                        [],
                        [],
                    ),
                ],
                'filter' => fn () => true,
                'metrics' => [
                    new Metric(
                        'http',
                        'http requests total site.com',
                        5,
                    ),
                ],
            ],
            [
                'snapshots' => [
                    new Snapshot(
                        new Subject('http', 'requests_total', 'http requests total :host:'),
                        [
                            new CounterRecord(5, [
                                'host' => 'site.com',
                            ]),
                        ],
                        [],
                        [],
                    ),
                    new Snapshot(
                        new Subject('http', 'request_durations', 'http request duration :host:'),
                        [],
                        [],
                        [
                            new CalculatedHistogramRecord(new CalculatedNumberList([], 0, 1), [], []),
                        ],
                    ),
                ],
                'filter' => fn () => true,
                'metrics' => [
                    new Metric(
                        'http',
                        'http requests total site.com',
                        5,
                    ),
                ],
            ],
            [
                'snapshots' => [
                    new Snapshot(
                        new Subject('http', 'requests_total', 'http requests total :host:'),
                        [
                            new CounterRecord(5, [
                                'host' => 'site.com',
                            ]),
                        ],
                        [],
                        [],
                    ),
                    new Snapshot(
                        new Subject('http', 'request_durations', 'http request duration :host:'),
                        [],
                        [],
                        [
                            new CalculatedHistogramRecord(
                                new CalculatedNumberList(
                                    [
                                        1.0,
                                        2.0,
                                    ],
                                    3.0,
                                    2,
                                ),
                                [],
                                [
                                    'host' => 'site.com',
                                ],
                            ),
                        ],
                    ),
                    new Snapshot(
                        new Subject('memory', 'memory_used', 'memory used :node:'),
                        [],
                        [
                            new GaugeRecord(256.0, [
                                'node' => 'srv-1',
                            ]),
                        ],
                        [],
                    ),
                ],
                'filter' => fn () => true,
                'metrics' => [
                    new Metric(
                        'http',
                        'http requests total site.com',
                        5,
                    ),
                    new Metric(
                        'http',
                        'http request duration site.com',
                        '2.0',
                    ),
                    new Metric(
                        'memory',
                        'memory used srv-1',
                        '256.0',
                    ),
                ],
            ],
        ];
    }
}
