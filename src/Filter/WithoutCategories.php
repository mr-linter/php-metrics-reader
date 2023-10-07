<?php

namespace MrLinter\Metrics\Reader\Filter;

use MrLinter\Contracts\Metrics\Subject;

final class WithoutCategories implements Filter
{
    /** @var array<string, bool> */
    private readonly array $keys;

    /**
     * @param array<string> $categories
     */
    public function __construct(array $categories)
    {
        $keys = [];

        foreach ($categories as $key) {
            $keys[$key] = true;
        }

        $this->keys = $keys;
    }

    public function filter(Subject $subject): bool
    {
        return ! isset($this->keys[$subject->category]);
    }
}
