<?php
session_start();
include_once __DIR__ . "../../app/Models/User.php";

$errors = [];
$data = $_POST;

/* авторизация */
if(isset($data['login'])){

    if (trim($data['login']) == ''){
        $errors[] = "Введите login";
    }

    $user = User::findUser($data['login']);
    /*Проверяем совпадение введенных пользователем данных*/
    if (empty($user)){
        if (trim($data['password']) == ''){
            $errors[] = "Введите password";
        }

        if(password_verify($data['password'], $user['password'])){
            /*
             * Записываем в сессию пользователя
             * Переходим на главную страницу
            */
            $_SESSION['user'] = $data['login'];
            header('Location: index.php');
        }
        else{
            $errors[] = "Не правильно введен пароль";
        }
    }else{
        /* Если пользователя нет в БД
        * регистрируем
         */
        if (trim($data['password']) == ''){
            $errors[] = "Введите password";
        }else{
            // хешируем пароль
            $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
            $user = User::insertUser($data['login'], $passwordHash);
            $_SESSION['user'] = $data['login'];
            header('Location: index.php');
        }

    }
}
