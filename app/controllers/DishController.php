<?php
require_once './models/Dish.php';
require_once './interfaces/IApiUsable.php';

class DishController extends Dish implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $name = $parametros['name'];
        $price = $parametros['price'];

        // Creamos el dish
        $dish = new Dish();
        $dish->name = $name;
        $dish->price = $price;
        $dish->createDish();

        $payload = json_encode(array("mensaje" => "Dish creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $dish = $args['name'];
        $dish = Dish::getDish($dish);
        $payload = json_encode($dish);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $list = Dish::getAll();
        $payload = json_encode(array("listOfDishes" => $list));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Dish::modifyDish($nombre);

        $payload = json_encode(array("mensaje" => "Dish modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        Dish::deleteDish($id);

        $payload = json_encode(array("mensaje" => "Dish borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
