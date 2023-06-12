<?php

class Dish
{
    public $id;
    public $name;
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

    public function createDish()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO dishes (name, price) VALUES (:name, :price)");
        $consulta->bindValue(':name', $this->name, PDO::PARAM_STR);
        $consulta->bindValue(':price', $this->price);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, price FROM dishes");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Dish');
    }

    public static function getDish($name)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, name, price FROM dishes WHERE name = :name");
        $consulta->bindValue(':name', $name, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Dish');
    }

    public static function modifyDish($dish)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE dishes SET name = :name, price = :price WHERE id = :id");
        $consulta->bindValue(':name', $dish->name, PDO::PARAM_STR);
        $consulta->bindValue(':price', $dish->price, PDO::PARAM_STR);
        $consulta->bindValue(':id', $dish->id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public static function deleteDish($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("DELETE dishes WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
    }

}