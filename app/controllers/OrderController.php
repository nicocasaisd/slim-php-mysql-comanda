<?php
require_once './models/Order.php';
require_once './interfaces/IApiUsable.php';

class OrderController extends Order implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $order_code = $parametros['order_code'];
        $order_list = $parametros['order_list'];
        $order_price = $parametros['order_price'];
        $order_status = $parametros['order_status'];

        // Creamos el order
        $order = new Order();
        $order->order_code = $order_code;
        $order->order_list = $order_list;
        $order->order_price = $order_price;
        $order->order_status = $order_status;
        $order->createOrder();

        $payload = json_encode(array("mensaje" => "Order creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['dish_id'];
        $order = Order::getOrder($id);
        $payload = json_encode($order);

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
