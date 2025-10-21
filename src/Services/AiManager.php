<?php

namespace Tncy\AiHelper\Services;

use Tncy\AiHelper\Contracts\AiDriverInterface;

class AiManager
{
    protected $app;
    protected $driver;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the default driver name.
     */
    public function getDefaultDriver(): string
    {
        return $this->app['config']['ai.default'] ?? 'openai';
    }

    /**
     * Get a driver instance.
     */
    public function driver(string $driver = null): AiDriverInterface
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if (is_null($this->driver)) {
            $this->driver = $this->createDriver($driver);
        }

        return $this->driver;
    }

    /**
     * Create a new driver instance.
     */
    protected function createDriver(string $driver): AiDriverInterface
    {
        $class = "Tncy\\AiHelper\\Drivers\\" . ucfirst($driver) . "Driver";
        
        if (class_exists($class)) {
            return new $class($this->app['config']['ai.drivers.' . $driver]);
        }

        throw new \InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * Complete a prompt.
     */
    public function complete(string $prompt): string
    {
        return $this->driver()->complete($prompt);
    }

    /**
     * Chat with messages.
     */
    public function chat(array $messages): string
    {
        return $this->driver()->chat($messages);
    }

    /**
     * Generate an image.
     */
    public function image(string $prompt): string
    {
        return $this->driver()->image($prompt);
    }

    /**
     * Dynamically call the default driver instance.
     */
    public function __call(string $method, array $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }
}