<?php

namespace Tncy\AiHelper\Tests;

use PHPUnit\Framework\TestCase;
use Tncy\AiHelper\Services\AiManager;
use Tncy\AiHelper\Contracts\AiDriverInterface;

class AiHelperTest extends TestCase
{
    public function testAiManagerCanBeCreated()
    {
        // Mock the application container
        $app = $this->createMock(\ArrayAccess::class);
        $app->expects($this->any())
            ->method('offsetGet')
            ->willReturnMap([
                ['config', ['ai.default' => 'openai']],
            ]);

        $manager = new AiManager($app);
        $this->assertInstanceOf(AiManager::class, $manager);
    }

    public function testAiManagerCanGetDefaultDriver()
    {
        // Mock the application container
        $app = $this->createMock(\ArrayAccess::class);
        $app->expects($this->any())
            ->method('offsetGet')
            ->willReturnMap([
                ['config', ['ai.default' => 'openai']],
            ]);

        $manager = new AiManager($app);
        $this->assertEquals('openai', $manager->getDefaultDriver());
    }
}