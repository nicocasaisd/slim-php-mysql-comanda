<?php

class Product
{
    public $id;
    public $name;
    public $type;
    public $price;


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

    public function createProduct()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO products (name, type, price) VALUES (:name, :type, :price)");
        $consulta->bindValue(':name', $this->name, PDO::PARAM_STR);
        $consulta->bindValue(':type', $this->type, PDO::PARAM_STR);
        $consulta->bindValue(':price', $this->price);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, type, price FROM products");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function getProduct($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, type, price FROM products WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Product');
    }

    public static function modifyProduct($product)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE products SET name = :name, price = :price, type = :type WHERE id = :id");
        $consulta->bindValue(':id', $product->id, PDO::PARAM_INT);
        $consulta->bindValue(':name', $product->name, PDO::PARAM_STR);
        $consulta->bindValue(':type', $product->type, PDO::PARAM_STR);
        $consulta->bindValue(':price', $product->price, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function deleteProduct($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE products WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}