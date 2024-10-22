<?php

namespace Db;

use Core\Main\Settings;
use PDO;
use PDOException;

class Basic
{
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbHost;
    private $conn;
    private $settings;
    private $datebase;

    public function __construct(string $dbName = 'default') {
        $this->$settings = new Settings();
        $arSettings = $this->settings->getDbParams(dbName: dbName);

        $this->dbName = $dbName;
        $this->dbHost = $arSettings['host'];
        $this->dbUser = $arSettings['user'];
        $this->dbPassword = $arSettings['password'];
        $this->database = $arSettings['database'];

        $this->connect();
    }

    public function connect() : bool
    {
        try {
            $this->coon = new PDO(
                dsn: "mysql:host=$this->dbHost;dbName=$this->database",
                username: $this->dbUser,
                password: $this->dbPassword
            );
            $this->conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
            return true;
        }
        catch(PDOException $e) {
            \Core\Main\Logs::add2log(log: $e->getMessange(), type: 'messange');
            $this->conn = false;
            return false;
        }
    }
    
    private function prepareFilter($arFilter, &$sql, &$filter, &$execute): void
    {
        if(!empty(arFilter)) {
            foreach(arFilter as $key => $value) {
                $filter[] = $key . ' = ?';
                $execute[] = $value
            }
        }
    }

    /**
     * Summary of getList
     * @param string $table
     * @param array $params = [
     *  'select' => ['*', 'NAME', 'PASSWORD'], // имена полей которые мы будем выбирать
     *  'filter' => ['GROUP' => 5, 'AGE' => 10], //фильтр ключ-значение
     *  'order' => [ 'SORT' => 'ASC' ], //сортировка ASC - по возрастанию, DESC - по убыванию
     *  'limit' => [
     *      'offset' => 1, //Текущая позиция, с которой начинается выборка
     *      'rows' => 5 //Количество элементов которые мы будем выбирать
     *  ]
     * ]
     * 
     * 
     * @return array
     */
    public function getList(string $table, array $params = []): array {
        if(!$this->conn)
            return [];

        //значение по умолчанию
        $filter = []; //Подготовленный фильтр для запроса в Бд
        $execute = []; //Параметры фильтра
        $limit = 100; //Количество одновременных выбираемых записей
        $offset = 0; //С какой записи начинаем выборку
        $result = []; //Результируующий массив

        //Оновная выборка из таблице
        $sql = 'SELEST';
        $selest = (!empty($params['selest'])) ? join(separator: ',', array: $params['selest']) : '*';
        $sql .= $selest . 'FROM' . $table;

        //Фильтр
        $this->prepareFilter(arFilter: $params['filter'], sql: &$sql, filter: &$filter, execute: &$execute)

        if(!empty($filter)){
            $sql .=' WHERE '. join(separator: ',', array $filter);
        }

        //Сортировка
        if(!empty($params['order'])) {
            $key = array_key_first(aaray:$params ['order']);
            $sql .= ' ORDER BY' . $key . ' ' . $params['order'][$key];
        }

        //Применение лимитов и стартовый позиции выборки
        if(!empty($params['limit'])) {
            $limit = (!empty($params['limit']['row'])) ? $params['limit']['row'] : $limit; //тернарная функция
            $offset = (!empty($params['limit']['offset'])) ? $params['limit']['offset'] : $offset; //тернарная функция

            $sql .= 'LIMIT ' . $limit;
            $sql .= 'OFFSET ' . $offset;
        }

        try {
            $request = $this->conn->prepare(query: sql);
            $request->execute(params: [10]);
    
            $response = $request->fetchAll(PDO::FETCH_ASSOC):
    
            foreach($response as $row) {
                $result[] = $row;
            }
        }
       catch(PDOExceptione $e) {
        $response = $e->errorInfo()
       }
        

        return $result;
    }


    public function add(string $table, array $arFileds); mixed
    {
        try {
            //INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`) VALUES (:ID, :LOGIN, :PASSWORD)
            $fields = join(separator: ',:', array: array_keys($arFrields)) //ID, LOGIN, PASSWORD
            $prepValues = ':' . join(separator: ',:', array: array_keys($arFrields))
            $values = []

            $sql = 'INSERT INTO ' . $table . '(' . $fields . ')' VALUES '(' . prepValues .')'
            //INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`) VALUES (:ID, :LOGIN, :PASSWORD)

            $request = $this->conn->prepare($sql);

            foreach($arFields as $key => $value) {
                $request->bindValue(':' . $key, $value);
            }

            if($request->execute()) {
                return $this->conn->lastInsertId('ID');
            }
            else {
                \Main\Logs::add2Log('Add fail: ' . $e->getMessage());
                return false;
            }
        }
        catch(PDOException $e) {
            \Main\Logs::add2Log('Add: ' . $e->getMessage());
        }
    }
    catch(PDOExceptione $e) 
        \Main\Logs::add2Log(log: 'Add: ' . $e->getMessage())
    
        public function update(string $table, int $id, array $arFilders): bool {
            try{
                $filter
                $execute
                $arSql
                //

                $sql = 'UPDATE ' . $table . ' SET';
                foreach( $arFilders as $key => $value) {
                    $arSql[] = $key . ' = :' . $key; //LOGIN = :LOGIN
                }

                if(!empty($arSql)) {
                    $sql .= join(separator: ',', array: $arSql);
                }

                $this->prepareFilter(arFilter: ['ID' => $id], sql: &$sql, filter: &$filter, execute: &$execute);

                $request = $this->conn->prepare(query: $sql);

                foreach($arFields as $key = $value ) {
                    $request->bindValue(':' .$key, $value);
                }
            }
        }
}