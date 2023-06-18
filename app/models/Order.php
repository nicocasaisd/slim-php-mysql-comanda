<?php

class Order
{
    public $id;
    public $dateTimeString;
    public $id_product;
    public $quantity;
    public $id_bill;
    public $id_waiter;
    public $id_cook;
    public $status;
    public $preparationDateTimeString;
    public $subtotal;


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
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO orders (dateTimeString, id_product, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal) VALUES (:dateTimeString, :id_product, :quantity, :id_bill, :id_waiter, :id_cook, :status, :preparationDateTimeString, :subtotal)");
        $consulta->bindValue(':dateTimeString', $this->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_product', $this->id_product, PDO::PARAM_INT);
        $consulta->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':id_bill', $this->id_bill, PDO::PARAM_INT);
        $consulta->bindValue(':id_waiter', $this->id_waiter, PDO::PARAM_INT);
        $consulta->bindValue(':id_cook', $this->id_cook, PDO::PARAM_INT);
        $consulta->bindValue(':status', $this->status, PDO::PARAM_STR);
        $consulta->bindValue(':preparationDateTimeString', $this->preparationDateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':subtotal', $this->subtotal);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        // $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_product, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM orders");
        $consulta = $dataAccessObject->prepareQuery("SELECT * FROM orders");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    public static function getOrder($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, dateTimeString, id_product, quantity, id_bill, id_waiter, id_cook, status, preparationDateTimeString, subtotal FROM orders WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Order');
    }

    public static function modifyOrder($order)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE orders SET dateTimeString=:dateTimeString, id_product=:id_product, quantity=:quantity, id_bill=:id_bill, id_waiter=:id_waiter, id_cook=:id_cook, status=:status, preparationDateTimeString=:preparationDateTimeString, subtotal=:subtotal WHERE id = :id");
        $consulta->bindValue(':id', $order->id, PDO::PARAM_INT);
        $consulta->bindValue(':dateTimeString', $order->dateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':id_product', $order->id_product, PDO::PARAM_INT);
        $consulta->bindValue(':quantity', $order->quantity, PDO::PARAM_INT);
        $consulta->bindValue(':id_bill', $order->id_bill, PDO::PARAM_INT);
        $consulta->bindValue(':id_waiter', $order->id_waiter, PDO::PARAM_INT);
        $consulta->bindValue(':id_cook', $order->id_cook, PDO::PARAM_INT);
        $consulta->bindValue(':status', $order->status, PDO::PARAM_STR);
        $consulta->bindValue(':preparationDateTimeString', $order->preparationDateTimeString, PDO::PARAM_STR);
        $consulta->bindValue(':subtotal', $order->subtotal);
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