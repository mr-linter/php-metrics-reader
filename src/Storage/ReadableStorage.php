<?php

namespace MrLinter\Metrics\Reader\Storage;

use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Storage;

/**
 * Interface for storages, which support reading.
 */
interface ReadableStorage extends Storage
{
    /**
     * Read snapshots from storage.
     *
     * @return iterable<Snapshot>
     */
    public function read(): iterable;
}
