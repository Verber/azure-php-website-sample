<?php
include_once('vendor/autoload.php');
ini_set('display_errors', 1);

$app = new Silex\Application();

$app->get('/blobs/', 'Demos\Blobs::index');
$app->post('/blobs/upload', 'Demos\Blobs::upload');

$app->get('/info/', phpinfo());
$app['debug'] = true;

$app->run();