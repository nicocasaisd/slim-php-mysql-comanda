<?php

class Dish
{
    public $id;
    public $name;
    public $price;


    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

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


}