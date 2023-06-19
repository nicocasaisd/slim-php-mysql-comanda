<?php
require_once './models/Table.php';
require_once './interfaces/IApiUsable.php';

class TableController extends Table implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id_table = $parametros['id_table'];
        $customerName = $parametros['customerName'];

        // Creamos el table
        $table = new Table();
        $table->dateTimeString = DateTimeController::getNowAsMySQL();
        $table->id_table = $id_table;
        $table->customerName = $customerName;
        $table->createTable();

        $payload = json_encode(array("mensaje" => "Table creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['order_id'];
        // $table = Table::getTable($id);
        // $payload = json_encode($table);

        // $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $list = Table::getAll();
        // var_dump($list);
        $payload = json_encode(array('listOfTables' => $list));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        // Table::modifyTable($nombre);

        $payload = json_encode(array("mensaje" => "Table modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        // Table::deleteTable($id);

        $payload = json_encode(array("mensaje" => "Table borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
