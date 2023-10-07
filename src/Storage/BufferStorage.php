<?php

namespace MrLinter\Metrics\Reader\Storage;

use MrLinter\Contracts\Metrics\Commit;
use MrLinter\Contracts\Metrics\Snapshot;

final class BufferStorage implements ReadableStorage
{
    /** @var iterable<Snapshot> */
    private iterable $snapshots = [];

    public function flush(Commit $commit, iterable $snapshots): void
    {
        $this->snapshots = $snapshots;
    }

    public function read(): iterable
    {
        $snapshots = $this->snapshots;

        $this->snapshots = [];

        return $snapshots;
    }
}
