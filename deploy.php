<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'xplorewebsite-live');

// Project repository
set('repository', 'git@github.com:shasin999-gcek/xplorewebsite.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('68.183.80.233')
    ->user('deployer')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/html/xplorewebsite-live');
//    ->set('deploy_path', '/var/www/html/xplorewebsite');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');
// before('deploy:symlink', 'artisan:db:seed');

