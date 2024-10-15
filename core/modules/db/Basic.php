<?php

namespace Core\Db;

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

    public function __construct(string $dbName = 'default') {
        $this->dbName = $dbName;
        $arSettings = Setting::getDbParams(dbName: dbName);
        $this->dbHost = $arSettings['host'];
        $this->dbUser = $arSettings['user'];
        $this->dbPassword = $arSettings['password'];

        $this->connect();
    }

    public function connect() : bool
    {
        try {
            $this->coon = new PDO(
                dsn: "mysql:host=$this->dbHost;dbName=$this->dbName",
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
    
    /**
     * Summary of getList
     * @param string $table
     * @param array $params = [
     *  'selest' => ['*', 'NAME', 'PASSWORD'], //имена полей которые мы будем выбирать
     *  'filter' => ['GROUP' => 5, 'AGE' => 10],
     *  'order' => ['SORT' => 'ACS'],
     * ]
     * 
     * 
     * 
     * 
     * 
     * 
     * 
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
        $selest = join(separator: ',', array $params['selest']) ?? '*';
        $sql .= $selest . 'FROM' .$table

        //Фильтр
        if(is_array(value: $params['filter']) && !empty($params['filter'])) {
            foreach($params['filter'] as $key => $value) {
                $filter[] = $key . ' = ?';
                $execute[] = $value
            }
        }

        if(!empty($filter)){
            $sql .=' WHERE '. join(separator: ',', array $filter);
        }

        //Сортировка
        if(!empty($params['order'])) {
            $key = array_key_first(aaray:$params ['order']);
            $sql .= ' ORDER DY' . $key . ' ' . $params['order'][$key];
        }

        //Применение лимитов и стартовый позиции выборки
        if(!empty($params['limit'])) {
            $limit = $params['limit']['row'] > 0 ? $params['limit']['row'] : $limit; //тернарная функция
            $offset = $params['limit']['offset'] > 0 ? $params['limit']['offset'] : $limit; //тернарная функция

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
       catch(PDJException $e) {
        $response = $e->errorInfo()
       }
        
        return $result;
    }

}