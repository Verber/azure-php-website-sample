<?php
include_once('vendor/autoload.php');
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

$app = new Silex\Application();

$app->get('/blobs/', 'Demos\Blobs::index');
$app->post('/blobs/upload', 'Demos\Blobs::upload');
$app->get('/blobs/delete/{name}', 'Demos\Blobs::delete')
    ->assert('name', '.+');

$app->get('/mysql/', 'Demos\MySQL::index');
$app->post('/mysql/register', 'Demos\MySQL::register');

$app->get('/tables/{tag}', 'Demos\Tables::index')
    ->value('tag', '');
$app->post('/tables/save', 'Demos\Tables::save');

$app->get('/queues/', 'Demos\Queues::index');
$app->post('/queues/add', 'Demos\Queues::add');
$app->post('/queues/list', 'Demos\Queues::dequeue');


$app->get('/info/', function() { phpinfo(); });
$app->get('/', 'Demos\Dashboard::index');

$app['debug'] = true;

$app->run();