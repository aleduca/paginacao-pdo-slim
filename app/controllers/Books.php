<?php

namespace app\controllers;

use app\database\models\Book;

class Books extends Base
{
    private $book;

    public function __construct()
    {
        $this->book = new Book;
    }

    public function index($request, $response)
    {
        $books = $this->book->setLimit(20)->setCurrentPage()->books('Harry');
        $links = $this->book->renderLinks($books['total']);

        return $this->getTwig()->render($response, $this->setView('site/books'), [
            'title' => 'Books',
            'books' => $books['registers'],
            'links' => $links
        ]);
    }
}
