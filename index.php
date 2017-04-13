<?php

require 'vendor/autoload.php';

//var_dump(class_exists(\Neer\Web\Controllers\HelloController::class)); exit;

$app = new Neer\App();

$request = $app->capture();
$response = $app->handle($app->capture());

$response->send();
$response->terminate();