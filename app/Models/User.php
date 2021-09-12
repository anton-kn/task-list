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
        $sql = "INSERT INTO users (login, password) VALUES ('".$login."', '".$password."')";
        $connect = new ConnectDB();
        $result = $connect->getConnect()->query($sql);
        $connect->closeConnect();
        return $result;
    }
    /*
     * Получаем данные пользователя по логину
     */
    public static function findUser($column, $param)
    {
        $sql = "SELECT $column FROM users WHERE login ='$param'";
        $connect = new ConnectDB();
        $result = $connect->getConnect()->query($sql)->fetch_all()[0];
        $connect->closeConnect();
        return array_shift($result);
    }
}