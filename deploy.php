<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'mawdoo3-clone');

// Project repository
set('repository', 'git@github.com:amrnn90/mawdoo3-clone.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// set('ssh_multiplexing', false);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('167.71.233.27')
    ->user('deployer')
    ->set('deploy_path', '/var/www/mawdoo3-clone');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

