<?php
require 'vendor/autoload.php';

foreach (glob("lib/*") as $filename) {
    require $filename;
}

$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => '../templates',
    'log.enabled' => true
));

$app->get('/hello/:name', function ($name) {
    echo "hello, $name";
});

$app->get('/', function () use ($app) {
    $app->log->debug("THIS IS HOW YOU DEBUG");
    echo "<h1>Go Ahead</h1>";
});

$app->get('/api/users', 'getUsers');
$app->get('/api/users/:id', 'getUser');
$app->get('/api/users/search/:query', 'findByName');
$app->post('/api/users', 'addUser');
$app->put('/api/users/:id', 'updateUser');
$app->delete('/api/users/:id', 'deleteUser');
$app->run();