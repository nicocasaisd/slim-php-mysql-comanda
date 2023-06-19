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

        try {
            $data = AuthJWT::ObtenerData($token);
            if($data->'user_type')
            $response = $handler->handle($request);
        } catch (Exception $e) {
            $response = new Response();
            $response->getBody()->write("Invalid Token.");
        }

        return $response;
    }
}
