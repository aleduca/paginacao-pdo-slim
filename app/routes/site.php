<?php

use app\controllers\Home;
use app\controllers\Books;
use app\controllers\Login;

$app->get('/', Home::class . ':index');
$app->get('/login', Login::class . ':index');
$app->post('/login', Login::class . ':store');
$app->get('/logout', Login::class . ':destroy');
$app->get('/books', Books::class . ':index');
