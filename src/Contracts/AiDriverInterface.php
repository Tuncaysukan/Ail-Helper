<?php

namespace Tncy\AiHelper\Contracts;

interface AiDriverInterface
{
    public function complete(string $prompt): string;

    public function chat(array $messages): string;

    public function image(string $prompt): string;
}