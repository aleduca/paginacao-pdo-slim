<?php

namespace app\database\models;

use PDOException;

class Book extends Base
{
    protected $table = 'books';

    public function books($searched)
    {
        try {
            // $query = $this->connection->query(
            //     "select SQL_CALC_FOUND_ROWS * from {$this->table} limit {$this->limit} offset {$this->offset}"
            // );
            $prepared = $this->connection->prepare("select SQL_CALC_FOUND_ROWS * from {$this->table} where title like :title limit {$this->limit} offset {$this->offset}");
            $prepared->bindValue(':title', '%' . $searched . '%');
            $prepared->execute();
            return [
                'registers' => $prepared->fetchAll(),
                'total' => $this->connection->query('SELECT FOUND_ROWS()')->fetchColumn()
            ];
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
