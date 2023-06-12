<?php

class Order
{
    public $id;
    public $order_code;
    public $order_status;
    public $order_list;
    public $order_price;


    //GETTER

    public function __get($atributo) 
    {
        if (property_exists($this, $atributo)) 
        {
            return $this->$atributo;
        }
    }

    // SETTER

    public function __set($atributo, $valor) 
    {
        if (property_exists($this, $atributo)) 
        {
          $this->$atributo = $valor;
        }
    }

    public function createOrder()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO dishes (name, type, price) VALUES (:name, :type, :price)");
        $consulta->bindValue(':name', $this->name, PDO::PARAM_STR);
        $consulta->bindValue(':type', $this->type, PDO::PARAM_STR);
        $consulta->bindValue(':price', $this->price);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, type, price FROM dishes");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    public static function getOrder($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, type, price FROM dishes WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Order');
    }

    public static function modifyOrder($dish)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE dishes SET name = :name, price = :price, type = :type WHERE id = :id");
        $consulta->bindValue(':id', $dish->id, PDO::PARAM_INT);
        $consulta->bindValue(':name', $dish->name, PDO::PARAM_STR);
        $consulta->bindValue(':type', $dish->type, PDO::PARAM_STR);
        $consulta->bindValue(':price', $dish->price, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function deleteOrder($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE dishes WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}