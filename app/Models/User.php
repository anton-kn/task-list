<?php
include_once __DIR__ . "../../../db/ConnectDB.php";

/*
 * Класс User записывать и проверять пользователя в БД
 */
class User
{

    private static $dataUser = [];

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
    public static function findUser($param)
    {
        $connect = new ConnectDB();
        /* Экранируем данные */
        $paramReal = $connect->getConnect()->real_escape_string($param);
        $sql = "SELECT * FROM users WHERE login ='$paramReal'";

        $result = $connect->getConnect()->query($sql)->fetch_all()[0];
        /* записываем id */
        self::$dataUser['id'] = $result[0];
        /* записываем логин */
        self::$dataUser['login'] = $result[1];
        /* записываем пароль */
        self::$dataUser['password'] = $result[2];
        $connect->closeConnect();
        return self::$dataUser;
    }

}