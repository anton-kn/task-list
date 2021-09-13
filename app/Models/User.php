<?php
include_once __DIR__ . "../../../db/ConnectDB.php";

/*
 * Класс User записывать и проверять пользователя в БД
 */
class User
{
    /*
     * Записываем пользователя
     */
    public static function insertUser($login, $password)
    {
        $connect = new ConnectDB();
        /* Экранируем данные */
        $loginReal = $connect->getConnect()->real_escape_string($login);
        $passwordReal = $connect->getConnect()->real_escape_string($password);
        $sql = "INSERT INTO users (login, password) VALUES ('$loginReal', '$passwordReal')";

        $result = $connect->getConnect()->query($sql);
        $connect->closeConnect();
        return $result;
    }
    /*
     * Получаем данные пользователя по логину
     */
    public static function findUser($column, $param)
    {
        $connect = new ConnectDB();
        /* Экранируем данные */
        $paramReal = $connect->getConnect()->real_escape_string($param);
        $sql = "SELECT $column FROM users WHERE login ='$paramReal'";

        $result = $connect->getConnect()->query($sql)->fetch_all()[0];
        $connect->closeConnect();
        return array_shift($result);
    }
}