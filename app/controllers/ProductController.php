<?php
require_once './models/Product.php';
require_once './interfaces/IApiUsable.php';

class ProductController extends Product implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $name = $parametros['name'];
        $type = $parametros['type'];
        $price = $parametros['price'];

        // Creamos el product
        $product = new Product();
        $product->name = $name;
        $product->type = $type;
        $product->price = $price;
        $product->createProduct();

        $payload = json_encode(array("mensaje" => "Product creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public static function CargarDesdeCSV($obj)
    {
      // Creamos el order
      $newObject = new Product();
      $newObject->name = $obj['name'];
      $newObject->type = $obj['type'];
      $newObject->price = $obj['price'];
      var_dump($obj);
  
      $newObject->createProduct();
  
      return $newObject;
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $id = $args['dish_id'];
        $product = Product::getProduct($id);
        $payload = json_encode($product);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $list = Product::getAll();
        $payload = json_encode(array('listOfProductes' => $list));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Product::modifyProduct($nombre);

        $payload = json_encode(array("mensaje" => "Product modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        Product::deleteProduct($id);

        $payload = json_encode(array("mensaje" => "Product borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
