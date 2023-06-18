<?php

class Order
{
    public $id;
    public $order_code;
    // public $order_list;
    public $order_price;
    public $order_status;


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
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO orders (order_code, order_list, order_price, order_status) VALUES (:order_code, :order_list, :order_price, :order_status)");
        $consulta->bindValue(':order_code', $this->order_code, PDO::PARAM_STR);
        $consulta->bindValue(':order_list', $this->order_list, PDO::PARAM_STR);
        $consulta->bindValue(':order_price', $this->order_price);
        $consulta->bindValue(':order_status', $this->order_status);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, order_code, order_list, order_price, order_status FROM orders");
        $consulta->execute();

        // var_dump($bool);

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    public static function getOrder($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, order_code, order_list, order_price, order_status FROM orders WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Order');
    }

    public static function modifyOrder($product)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE orders SET order_code = :order_code, order_price = :order_price, order_list = :order_list, order_status = :order_status WHERE id = :id");
        $consulta->bindValue(':id', $product->id, PDO::PARAM_INT);
        $consulta->bindValue(':order_code', $product->order_code, PDO::PARAM_STR);
        $consulta->bindValue(':order_list', $product->order_list, PDO::PARAM_STR);
        $consulta->bindValue(':order_price', $product->order_price, PDO::PARAM_STR);
        $consulta->bindValue(':order_status', $product->order_status, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function deleteOrder($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE orders WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}