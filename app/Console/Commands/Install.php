<?php
/**
 * Copyright (c) 2017 Andrey Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Penati\Role;
use Penati\User;

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
        if(Role::where('name', 'client')->first()) {
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

        $admin_password = $this->askOption(
            'password',
            'Specify the administrator password',
            'required|min:6|regex:/(?=.*[a-zA-Z])(?=.*\d)/'
        );

        $user = User::create([
            'name' => 'Administrator',
            'email' => $admin_email,
            'password' => bcrypt($admin_password),
        ]);
        $user->roles()->attach(Role::where('name', 'admin')->first());
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
     * Validates the user input
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
            $attribute => $value
        ], [
            $attribute => $validation
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first($attribute));
        }

        return $value;
    }
}
