<?php

class Table
{
    public $id;
    public $status;
    public $sector;

    public function createTable()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO tables (status, sector) VALUES (:status, :sector)");
        $consulta->bindValue(':status', $this->status, PDO::PARAM_STR);
        $consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        // $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_product, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM tables");
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM tables");
        $consulta->execute();


        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Table');
    }

    public static function modifyStatus($id, $status)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE tables SET status=:status WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':status', $status, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function deleteTable($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE tables WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}