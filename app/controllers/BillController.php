<?php
require_once './models/Bill.php';
require_once './interfaces/IApiUsable.php';

class BillController extends Bill implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id_table = $parametros['id_table'];
        $customerName = $parametros['customerName'];

        // Creamos el bill
        $bill = new Bill();
        $bill->dateTimeString = DateTimeController::getNowAsMySQL();
        $bill->id_table = $id_table;
        $bill->customerName = $customerName;
        $bill->createBill();

        $payload = json_encode(array("mensaje" => "Bill creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public static function CargarDesdeCSV($obj)
    {
      // Creamos el order
      $newObject = new Bill();
      $newObject->dateTimeString = $obj['dateTimeString'];
      $newObject->id_table = $obj['id_table'];
      $newObject->customerName = $obj['customerName'];
      var_dump($obj);
  
      $newObject->createBill();
  
      return $newObject;
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['order_id'];
        // $bill = Bill::getBill($id);
        // $payload = json_encode($bill);

        // $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $list = Bill::getAll();
        // var_dump($list);
        $payload = json_encode(array('listOfBills' => $list));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        // Bill::modifyBill($nombre);

        $payload = json_encode(array("mensaje" => "Bill modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        // Bill::deleteBill($id);

        $payload = json_encode(array("mensaje" => "Bill borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
