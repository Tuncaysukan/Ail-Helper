<?php

namespace Tncy\AiHelper\Drivers;

use Tncy\AiHelper\Contracts\AiDriverInterface;
use GuzzleHttp\Client;

class OpenAiDriver implements AiDriverInterface
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
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config['api_key'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->config['model'] ?? 'gpt-4-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'] ?? '';
    }

    /**
     * Chat with messages.
     */
    public function chat(array $messages): string
    {
        $formattedMessages = array_map(function ($message) {
            return is_array($message) ? $message : ['role' => 'user', 'content' => $message];
        }, $messages);

        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config['api_key'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->config['model'] ?? 'gpt-4-turbo',
                'messages' => $formattedMessages
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'] ?? '';
    }

    /**
     * Generate an image.
     */
    public function image(string $prompt): string
    {
        $response = $this->client->post('https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config['api_key'],
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $prompt,
                'n' => 1,
                'size' => '1024x1024',
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['data'][0]['url'] ?? '';
    }
}