<?php

namespace MrLinter\Metrics\Reader\Storage;

use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Storage;

interface ReadableStorage extends Storage
{
    /**
     * @return iterable<Snapshot>
     */
    public function read(): iterable;
}
