<?php
require_once './models/Order.php';
require_once './interfaces/IApiUsable.php';

class OrderController extends Order implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $name = $parametros['name'];
        $type = $parametros['type'];
        $price = $parametros['price'];

        // Creamos el dish
        $dish = new Order();
        $dish->name = $name;
        $dish->type = $type;
        $dish->price = $price;
        $dish->createOrder();

        $payload = json_encode(array("mensaje" => "Order creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['dish_id'];
        $dish = Order::getOrder($id);
        $payload = json_encode($dish);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $list = Order::getAll();
        // var_dump($list);
        $payload = json_encode(array('listOfOrders' => $list));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Order::modifyOrder($nombre);

        $payload = json_encode(array("mensaje" => "Order modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        Order::deleteOrder($id);

        $payload = json_encode(array("mensaje" => "Order borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
