<?php
require_once './models/User.php';
require_once './interfaces/IApiUsable.php';

class UserController extends User implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $user_name = $parametros['user_name'];
        $password = $parametros['password'];
        echo 'password: '.$password;

        // Creamos el user_name
        $usr = new User();
        $usr->user_name = $user_name;
        $usr->password = $password;
        $usr->createUser();

        $payload = json_encode(array("mensaje" => "User creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos user_name por nombre
        $usr = $args['user_name'];
        $user_name = User::getUser($usr);
        $payload = json_encode($user_name);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = User::getAll();
        $payload = json_encode(array("listaUsuario" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        User::modifyUser($nombre);

        $payload = json_encode(array("mensaje" => "User modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $usuarioId = $parametros['usuarioId'];
        User::deleteUser($usuarioId);

        $payload = json_encode(array("mensaje" => "User borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
