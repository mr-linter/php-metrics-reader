<?php

namespace MrLinter\Metrics\Reader\Tests\Unit\Storage;

use MrLinter\Contracts\Metrics\Commit;
use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\Storage\BufferStorage;
use PHPUnit\Framework\TestCase;

final class BufferStorageTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\BufferStorage::flush
     * @covers \MrLinter\Metrics\Reader\BufferStorage::read
     * @covers \MrLinter\Metrics\Reader\BufferStorage::__construct
     */
    public function testFlush(): void
    {
        $storage = new BufferStorage();

        $storage->flush(new Commit(''), $snapshots = [
            new Snapshot(new Subject('', '', ''), [], [], []),
        ]);

        self::assertEquals($snapshots, $storage->read());

        self::assertEquals([], $storage->read());
    }
}
