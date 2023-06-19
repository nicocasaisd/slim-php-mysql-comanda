<?php

class User
{
    public $id;
    public $user_name;
    public $password;
    public $user_type;


    

    public function createUser()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO users (user_name, password, user_type) VALUES (:user_name, :password, :user_type)");
        $claveHash = password_hash($this->password, PASSWORD_DEFAULT);
        $consulta->bindValue(':user_name', $this->user_name, PDO::PARAM_STR);
        $consulta->bindValue(':password', $claveHash);
        $consulta->bindValue(':user_type', $this->user_type, PDO::PARAM_STR);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, user_name, password, user_type FROM users");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function getUser($user_name)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, user_name, password, user_type FROM users WHERE user_name = :user_name");
        $consulta->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('User');
    }

    public static function modifyUser($user)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE users SET user_name = :user_name, password = :password WHERE id = :id");
        $consulta->bindValue(':user_name', $user->user_name, PDO::PARAM_STR);
        $consulta->bindValue(':password', $user->password, PDO::PARAM_STR);
        $consulta->bindValue(':id', $user->id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public static function deleteUser($id)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE users SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }
}