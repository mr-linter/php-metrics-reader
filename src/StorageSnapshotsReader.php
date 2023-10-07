<?php

namespace MrLinter\Metrics\Reader;

use MrLinter\Metrics\Reader\Filter\Filter;
use MrLinter\Metrics\Reader\Storage\ReadableStorage;

final class StorageSnapshotsReader implements Reader
{
    public function __construct(
        private readonly ReadableStorage     $storage,
        private readonly MetricTitleRenderer $titleRenderer,
    ) {
    }

    public function read(Filter $filter): iterable
    {
        $reader = new SnapshotsReader($this->storage->read(), $this->titleRenderer);

        return $reader->read($filter);
    }
}
