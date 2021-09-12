<?php
include_once __DIR__ . "../../app/Models/User.php";
$data = $_POST;

//var_dump(User::selectUser($data['login']));

if (isset($data['signup'])){
//    записываем успешную запись в БД
    $log = [];
//    записываем ошибки при проверке
    $errors = [];
    if (trim($data['login']) == ''){
        $errors[] = "Введите login";
    }
    if (trim($data['password']) == ''){
        $errors[] = "Введите password";
    }
    if (trim($data['password_2']) == ''){
        $errors[] = "Введите password";
    }

//    cравниваем пароли
    if($data['password'] != $data['password_2']){
        $errors[] = "Пароли не совпадают";
    }

//   проверяем длины логина и пароля
    if (mb_strlen($data['login']) < 3 || mb_strlen($data['login']) > 20){
        $errors[] = "Измените длину login";
    }

    if (mb_strlen($data['password']) < 4 || mb_strlen($data['password']) > 20){
        $errors[] = "Измените длину пароля";
    }

//    проверяем на повторяемость логина из БД

    if(User::findUser('login', $data['login']) == $data['login']){
        $errors[] = "Пользователь с таким логином уже есть";
    }

    // Если ошибок нет
    if(empty($errors)){
        // хешируем пароль
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = User::insertUser($data['login'], $passwordHash);
        $log[] = 'Вы зарегистрированы. Можно <a class="underline" href ="/login.php">авторизоваться</a>' ;
    }

}