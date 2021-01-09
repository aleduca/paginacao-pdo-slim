<?php

namespace app\database\models;

use Exception;

class Book extends Base
{
    protected $table = 'books';

    public function books()
    {
        try {
            $query = $this->connection->query(
                "select SQL_CALC_FOUND_ROWS * from books limit {$this->limit} offset {$this->offset}"
            );

            return [
                'registers' => $query->fetchAll(),
                'total' => $this->connection->query('SELECT FOUND_ROWS()')->fetchColumn()
            ];
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
