<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Import the prompt functions directly
use function Laravel\Prompts\text;
use function Laravel\Prompts\password;
use function Laravel\Prompts\select;
use function Laravel\Prompts\confirm;

class SetupUserCommand extends Command
{
    /**
     * The signature you run in the terminal: php artisan demo:prompts
     */
    protected $signature = 'demo:prompts';

    protected $description = 'Demonstrating inline configuration for Laravel Prompts';

    public function handle()
    {
        // 1. Text Prompt Configuration
        $name = text(
            label: 'What is your project name?',
            placeholder: 'my-awesome-app',
            default: 'laravel-app',
            hint: 'This will be used for your root directory.',
            required: 'Project name cannot be empty!',
            validate: fn (string $value) => match (true) {
                strlen($value) < 3 => 'The name must be at least 3 characters.',
                preg_match('/\s/', $value) => 'Spaces are not allowed.',
                default => null
            }
        );

        // 2. Password Prompt Configuration
        $secret = password(
            label: 'Enter your API key:',
            placeholder: 'sk_live_...',
            required: true
        );

        // 3. Select Options Configuration
        $environment = select(
            label: 'Target Deployment Environment:',
            options: [
                'local' => 'Local Development',
                'staging' => 'Staging / QA',
                'production' => 'Production Server',
            ],
            default: 'local',
            hint: 'Production will trigger an extra confirmation.'
        );

        // 4. Confirmation Prompt Configuration
        if ($environment === 'production') {
            $proceed = confirm(
                label: 'Are you absolutely sure you want to deploy to PRODUCTION?',
                default: false,
                yes: 'Yes, deploy now',
                no: 'Cancel deployment'
            );

            if (! $proceed) {
                $this->warn('Deployment canceled.');
                return;
            }
        }

        $this->info("Setup complete for {$name}!");
    }
}
