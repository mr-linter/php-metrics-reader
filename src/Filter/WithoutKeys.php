<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class WithoutKeys implements Filter
{
    /** @var array<string, bool> */
    private readonly array $keys;

    /**
     * @param array<string> $keys
     */
    public function __construct(array $keys)
    {
        $mapped = [];

        foreach ($keys as $key) {
            $mapped[$key] = true;
        }

        $this->keys = $mapped;
    }

    public function filter(Subject $subject): bool
    {
        return ! isset($this->keys[$subject->key]);
    }
}
