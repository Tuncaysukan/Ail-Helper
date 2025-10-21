<?php

namespace Tncy\AiHelper\Drivers;

use Tncy\AiHelper\Contracts\AiDriverInterface;
use GuzzleHttp\Client;

class AnthropicDriver implements AiDriverInterface
{
    protected $config;
    protected $client;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client();
    }

    /**
     * Complete a prompt.
     */
    public function complete(string $prompt): string
    {
        $response = $this->client->post('https://api.anthropic.com/v1/messages', [
            'headers' => [
                'x-api-key' => $this->config['api_key'],
                'Content-Type' => 'application/json',
                'anthropic-version' => '2023-06-01',
            ],
            'json' => [
                'model' => $this->config['model'] ?? 'claude-3-sonnet-20240229',
                'max_tokens' => 1024,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['content'][0]['text'] ?? '';
    }

    /**
     * Chat with messages.
     */
    public function chat(array $messages): string
    {
        $formattedMessages = array_map(function ($message) {
            return is_array($message) ? $message : ['role' => 'user', 'content' => $message];
        }, $messages);

        $response = $this->client->post('https://api.anthropic.com/v1/messages', [
            'headers' => [
                'x-api-key' => $this->config['api_key'],
                'Content-Type' => 'application/json',
                'anthropic-version' => '2023-06-01',
            ],
            'json' => [
                'model' => $this->config['model'] ?? 'claude-3-sonnet-20240229',
                'max_tokens' => 1024,
                'messages' => $formattedMessages
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['content'][0]['text'] ?? '';
    }

    /**
     * Generate an image.
     */
    public function image(string $prompt): string
    {
        // Anthropic doesn't support image generation directly
        // This is a placeholder implementation
        return "Image generation not supported by Anthropic driver. Prompt was: $prompt";
    }
}