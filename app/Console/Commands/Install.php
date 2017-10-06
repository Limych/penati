<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>.
 */

namespace Penati\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install {--force} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check for application already installed
        if (in_array('users', DB::getDoctrineSchemaManager()->listTableNames())) {
            if (! $this->option('force')) {
                throw new \RuntimeException('This application already installed.');
            }
        }

        $this->call('migrate:fresh', [
            '--seed' => 'default',
        ]);

        $admin_email = $this->askOption(
            'email',
            'Specify the administrator email',
            'required|email'
        );

        $this->call('make:user', [
            '--name' => 'Admin',
            '--password' => $this->option('password'),
            'email' => $admin_email,
        ]);
    }

    protected function askOption($name, $question, $validation)
    {
        return $this->option($name)
            ?: $this->output->ask(
                $question,
                null,
                function ($value) use ($name, $validation) {
                    return $this->validateInput($name, $validation, $value);
                }
            );
    }

    /**
     * Validates the user input.
     *
     * @param string $attribute
     * @param string $validation
     * @param string $value
     * @return string
     * @throws \Exception
     */
    protected function validateInput(string $attribute, string $validation, $value)
    {
        $validator = Validator::make([
            $attribute => $value,
        ], [
            $attribute => $validation,
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first($attribute));
        }

        return $value;
    }
}
