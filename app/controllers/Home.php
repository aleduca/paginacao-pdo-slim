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
        $searched = $_GET['s'] ?? '';
        $books = $this->book->setLimit(20)->setCurrentPage()->books($searched);
        $links = $this->book->renderLinks($books['total']);

        $message = Flash::get('message');

        // var_dump($_SERVER['QUERY_STRING']);

        return $this->getTwig()->render($response, $this->setView('site/home'), [
            'title' => 'Home',
            'message' => $message,
            'books' => $books['registers'],
            'links' => $links
        ]);
    }
}
