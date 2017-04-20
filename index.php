<?php

require 'vendor/autoload.php';

$app = new Neer\App();

$request = $app->capture();
$response = $app->handle($app->capture());

$response->send();
$response->terminate();