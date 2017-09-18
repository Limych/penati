<?php
namespace Deployer;

require 'vendor/deployer/deployer/recipe/laravel.php';

// Project name
set('application', 'penati.ru');

// Project repository
set('repository', 'https://github.com/Limych/penati.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('reg-ru.penati.ru')
    ->user('u0386811')
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/id_rsa')
    ->stage('production')
    ->set('deploy_path', '~/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

