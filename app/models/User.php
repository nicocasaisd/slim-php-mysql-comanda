<?php

class User
{
    public $id;
    public $user;
    public $password;

    public function createUser()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("INSERT INTO users (user, password) VALUES (:user, :password)");
        $claveHash = password_hash($this->password, PASSWORD_DEFAULT);
        $consulta->bindValue(':user', $this->user, PDO::PARAM_STR);
        $consulta->bindValue(':password', $claveHash);
        $consulta->execute();

        return $dataAccessObject->getLastId();
    }

    public static function getAll()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, user, password FROM users");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function getUser($user)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("SELECT id, user, password FROM users WHERE user = :user");
        $consulta->bindValue(':user', $user, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('User');
    }

    public static function modifyUser()
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE users SET user = :user, password = :password WHERE id = :id");
        $consulta->bindValue(':user', $this->user, PDO::PARAM_STR);
        $consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
    }

    public static function deleteUser($user)
    {
        $dataAccessObject = DataAccess::getInstance();
        $consulta = $dataAccessObject->prepareQuery("UPDATE users SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y"));
        $consulta->bindValue(':id', $user, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }
}