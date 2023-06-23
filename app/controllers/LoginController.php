<?php

require_once './models/User.php';
require_once './middlewares/AuthJWT.php';

class LoginController
{
    public function ValidateLogin($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $user_name = $parametros['user_name'];
        $password = $parametros['password'];

        $user = User::getUser($user_name);
        
        if($user && password_verify($password, $user->password))
        {
            $data = json_encode(array('id'=>$user->id, 'user'=>$user_name, 'user_type'=>$user->user_type));
            $jwt = AuthJWT::CrearToken($data);
            $payload = json_encode(array('jwt' => $jwt));
        }
        else{
            $payload = json_encode(array('Error' => 'Invalid user or password'));
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
