<?php

class Bill
{
    public $id;
    public $dateTimeString;
    public $id_table;
    public $customerName;


    public function createBill()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO bills (dateTimeString, id_table, customerName) VALUES (:dateTimeString, :id_table, :customerName)");
        $consulta->bindValue(':dateTimeString', $this->dateTimeString);
        $consulta->bindValue(':id_table', $this->id_table, PDO::PARAM_INT);
        $consulta->bindValue(':customerName', $this->customerName, PDO::PARAM_STR);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        // $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_product, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM bills");
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM bills");
        $consulta->execute();


        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Bill');
    }



}
