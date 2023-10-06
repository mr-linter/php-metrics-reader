<?php

namespace MrLinter\Metrics\Reader\Tests;

use MrLinter\Contracts\Metrics\Subject;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    final protected static function createEmptyMetricSubject(): Subject
    {
        return new Subject('', '', '');
    }
}
