<?php

namespace app\controllers;

use app\classes\Flash;
use app\database\models\Book;

class Home extends Base
{
    private $book;

    public function __construct()
    {
        $this->book = new Book;
    }

    public function index($request, $response)
    {
        $books = $this->book->setLimit(20)->setCurrentPage()->books();
        $links = $this->book->renderLinks($books['total']);

        $message = Flash::get('message');

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'message' => $message,
            'books' => $books['registers'],
            'links' => $links
        ]);
    }
}
