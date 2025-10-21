<?php

namespace Tncy\AiHelper\Commands;

use Illuminate\Console\Command;
use Tncy\AiHelper\Facades\Ai;

class AiTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ai:test {prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AI Helper test komutu';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $result = Ai::complete($this->argument('prompt'));
        $this->info($result);
    }
}