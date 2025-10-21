<?php

if (!function_exists('ai')) {
    /**
     * Helper function to access the AI service.
     */
    function ai(string $prompt): string
    {
        return app('ai')->complete($prompt);
    }
}