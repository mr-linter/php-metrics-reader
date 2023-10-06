<?php

namespace MrLinter\Metrics\Reader\Tests\Unit;

use MrLinter\Contracts\Metrics\Subject;
use MrLinter\Metrics\Reader\MetricTitleRenderer;
use PHPUnit\Framework\TestCase;

final class MetricTitleRendererTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\Reader\MetricTitleRenderer::render
     */
    public function testRender(): void
    {
        $renderer = new MetricTitleRenderer();

        self::assertEquals(
            'metric test',
            $renderer->render(
                new Subject('', '', 'metric :name:'),
                [
                    'name' => 'test',
                ],
            ),
        );
    }
}
