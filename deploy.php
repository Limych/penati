<?php

namespace Deployer;

require 'vendor/deployer/deployer/recipe/laravel.php';

// Project name
set('application', 'penati.ru');

// Project repository
set('repository', 'https://github.com/Limych/penati.git');
set('branch', 'master');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Activate SSH multiplexing
set('ssh_multiplexing', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Default stage
set('default_stage', 'production');

// Hosts

host('penati-reg')
    ->configFile('~/.ssh/config')
    ->stage('production')
    ->set('deploy_path', '~/{{application}}')
    ->set('bin/php', function () {
        $php = run('cat ~/php-bin/php');
        $php = preg_replace('/^\#\!/', '', $php);
        $php = preg_replace('/-cgi$/', '', $php);

        return $php;
    })
    ->set('writable_mode', 'chmod');

// Tasks

//task('build', function () {
//    run('cd {{release_path}} && build');
//});

// Add symlink to current PHP version
desc('Add symlink to current PHP version');
task('penati:php', function () {
    run('cd {{release_path}} && ln -s {{bin/php}}');
});
after('deploy:shared', 'penati:php');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
