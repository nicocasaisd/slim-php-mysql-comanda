<?php
class DataAccess
{
    private static $dataAccessObject;
    private $objectPDO;

    private function __construct()
    {
        try {
            $this->objectPDO = new PDO('mysql:host='.$_ENV['MYSQL_HOST'].';dbname='.$_ENV['MYSQL_DB'].';charset=utf8;port='.$_ENV['MYSQL_PORT'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASS'], array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // $this->objectPDO = new PDO('mysql:host='. 'localhost'.';port='.'3306' .';dbname='.'comanda_db'.';charset=utf8;', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objectPDO->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$dataAccessObject)) {
            self::$dataAccessObject = new DataAccess();
        }
        return self::$dataAccessObject;
    }

    public function prepareQuery($sql)
    {
        return $this->objectPDO->prepare($sql);
    }

    public function getLastId()
    {
        return $this->objectPDO->lastInsertId();
    }

    public function __clone()
    {
        trigger_error('ERROR: Cloning not permited', E_USER_ERROR);
    }
}
