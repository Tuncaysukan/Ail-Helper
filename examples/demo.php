<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Example usage of the AI Helper

use Tncy\AiHelper\Facades\Ai;

// Text completion
$text = Ai::complete('Explain what Laravel is in one sentence.');
echo "Text completion result:\n" . $text . "\n\n";

// Chat conversation
$chatResult = Ai::chat([
    ['role' => 'user', 'content' => 'What are the benefits of using Laravel?'],
    ['role' => 'assistant', 'content' => 'Laravel provides a robust framework with features like Eloquent ORM, Blade templating, and Artisan CLI.'],
    ['role' => 'user', 'content' => 'Can you elaborate on Eloquent ORM?']
]);
echo "Chat result:\n" . $chatResult . "\n\n";

// Image generation (OpenAI only)
$imageUrl = Ai::image('A logo for a Laravel-based e-commerce platform');
echo "Image URL:\n" . $imageUrl . "\n\n";

// Using the helper function
$helperResult = ai('What is the latest version of Laravel?');
echo "Helper function result:\n" . $helperResult . "\n";