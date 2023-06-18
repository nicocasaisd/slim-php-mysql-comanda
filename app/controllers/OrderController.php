<?php
require_once './models/Order.php';
require_once './interfaces/IApiUsable.php';

class OrderController extends Order implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id_product = $parametros['id_product'];
        $quantity = $parametros['quantity'];
        $id_bill = $parametros['id_bill'];
        $id_waiter = $parametros['id_waiter'];

        // Creamos el order
        $order = new Order();
        $order->id_product = $id_product;
        $order->quantity = $quantity;
        $order->id_bill = $id_bill;
        $order->id_waiter = $id_waiter;
        $order->createOrder();

        $payload = json_encode(array("mensaje" => "Order creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['order_id'];
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
