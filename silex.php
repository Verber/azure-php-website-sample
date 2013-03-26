<?php
include_once('vendor/autoload.php');
ini_set('display_errors', 1);

try {
    $app = new Silex\Application();

    $app->get('/blobs/', 'Demos\Blobs::index');
    $app->post('/blobs/upload', 'Demos\Blobs::upload');
    $app['debug'] = true;

    $app->run();
} catch (Exception $e) {
    die($e->getMessage());
}