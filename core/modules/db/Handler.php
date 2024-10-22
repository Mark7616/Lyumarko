<?php

namespace Db;

use Db\Basic;

 final class Handler extends Basic {
    public function deleteById(string $table, int $id) {
        return $this->delete($table, ['filter' => ["ID"=> $id]]);
    }
    public function getByID(string $table, int $id) {
        return $this->getList($table, ['filter' => ["ID"=> $id]]);
    }
}