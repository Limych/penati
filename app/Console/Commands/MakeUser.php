<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

namespace Penati\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\Facades\Validator;

class MakeUser extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {email : The email address of the user}
                            {--name= : Will assign the name to the user (Optional)}
                            {--password= : Allows you to specify the password (Optional)}
                            {--userclass=\App\User : the user class itself, will use Laravel\'s default when omitted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user based on the email supplied';

    /**
     * the user class definition
     */
    var $userClass;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->userClass = '\\' . $this->getAppNamespace() . 'User';
        $this->signature = str_replace('\App\User', $this->userClass, $this->signature);

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Email Address of the User
        $emailAddress = $this->argument('email');
        // Default user class within project
        $userClass = strlen($this->option('userclass')) ? trim($this->option('userclass')) : $this->userClass;
        $userDb = new $userClass;

        // Checking for the user existence
        if($userDb::where('email', $emailAddress)->count() > 0) {
            $this->error('Email address already exists');
            return;
        }

        // Name of the User (default to use Email Address)
        $name = $this->option('name') ? $this->option('name') : $emailAddress;
        // Prompt for password, unless specified, or generate random password when no interaction mode
        $password = $this->option('password') ?: ( $this->option('no-interaction')
            ? str_random(8)
            : $this->askOption(
                'password',
                'Specify the user password (required at least one letter and one number)',
                'required|min:6|regex:/(?=.*[a-zA-Z])(?=.*\d)/'
            )
        );

        $this->info("Creating user for: <$emailAddress>");
        $userDb::create([
            'name'     => $name,
            'email'    => $emailAddress,
            'password' => bcrypt($password),
        ]);

        $this->info("Password has been set to: '$password'");
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
