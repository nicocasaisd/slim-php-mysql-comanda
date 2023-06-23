<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

include_once './middlewares/AuthJWT.php';

class AuthorizationMW
{
    public function ValidateToken(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(explode("Bearer", $header)[1]);

        // var_dump($token);
        // var_dump(AuthJWT::ObtenerPayLoad($token));
        try {
            AuthJWT::VerificarToken($token);
            $response = $handler->handle($request);
        } catch (Exception $e) {
            $response = new Response();
            $response->getBody()->write("Invalid Token.");
        }

        return $response;
    }

    public function ValidateAdmin(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(explode("Bearer", $header)[1]);


        $data = AuthJWT::ObtenerData($token);
        $data = json_decode($data);
        // var_dump($data);
        if ($data->user_type == 'ADMIN') {
            $response = $handler->handle($request);
        } else {
            $response = new Response();
            $response->getBody()->write("Acceso denegado. Debe ser ADMIN para ingresar.");
        }

        return $response;
    }

    public function ValidateWaiter(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(explode("Bearer", $header)[1]);


        $data = AuthJWT::ObtenerData($token);
        $data = json_decode($data);
        // var_dump($data);
        if (
            $data->user_type == 'WAITER'
            || $data->user_type == 'ADMIN'
        ) {
            $response = $handler->handle($request);
        } else {
            $response = new Response();
            $response->getBody()->write("Acceso denegado. Debe ser WAITER para ingresar.");
        }

        return $response;
    }

    public function ValidateCook(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(explode("Bearer", $header)[1]);


        $data = AuthJWT::ObtenerData($token);
        $data = json_decode($data);
        // var_dump($data);
        if (
            $data->user_type == 'COOK'
            || $data->user_type == 'ADMIN'
        ) {
            $response = $handler->handle($request);
        } else {
            $response = new Response();
            $response->getBody()->write("Acceso denegado. Debe ser COOK para ingresar.");
        }

        return $response;
    }

    public function ValidateBrewer(Request $request, RequestHandler $handler): Response
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(explode("Bearer", $header)[1]);


        $data = AuthJWT::ObtenerData($token);
        $data = json_decode($data);
        // var_dump($data);
        if (
            $data->user_type == 'BREWER'
            || $data->user_type == 'ADMIN'
        ) {
            $response = $handler->handle($request);
        } else {
            $response = new Response();
            $response->getBody()->write("Acceso denegado. Debe ser BREWER para ingresar.");
        }

        return $response;
    }
}
