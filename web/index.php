<?php

use Slim\App;
use TalkWhyTdd\Infrastructure\Middlewares\RequestBodyParserMiddleware;
use TalkWhyTdd\Infrastructure\Controllers\CheckUsernameController;

require __DIR__.'/../vendor/autoload.php';

$app = new Slim\App();

$app->add(RequestBodyParserMiddleware::class);

$app->post('/check-username', CheckUsernameController::class);

$app->run();
