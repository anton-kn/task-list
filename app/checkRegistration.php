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

    if (trim($data['password']) == ''){
        $errors[] = "Введите password";
    }
    $user = User::findUser('login', $data['login']);
    /*Проверяем совпадение введенные пользователем данные*/
    if ($user == $data['login']){
        if(password_verify($data['password'], User::findUser('password', $data['login']))){
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
        $errors[] = "Пользователя с таким логином нет. Прошу зарегистрироваться ниже";
        $_SESSION['state'] = true;
    }
}

/* Регистрация */
if (isset($data['signup'])) {
//    записываем ошибки при проверке

    if (trim($data['login_sup']) == '') {
        $errors[] = "Введите login";
    }
    if (trim($data['password_sup']) == '') {
        $errors[] = "Введите password";
    }
    if (trim($data['password_sup_2']) == '') {
        $errors[] = "Введите password";
    }

//    cравниваем пароли
    if ($data['password_sup'] != $data['password_sup_2']) {
        $errors[] = "Пароли не совпадают";
    }

//   проверяем длины логина и пароля
    if (mb_strlen($data['login_sup']) < 3 || mb_strlen($data['login_sup']) > 20) {
        $errors[] = "Измените длину login";
    }

    if (mb_strlen($data['password_sup']) < 4 || mb_strlen($data['password_sup']) > 20) {
        $errors[] = "Измените длину пароля";
    }

//    проверяем на повторяемость логина из БД

    if (User::findUser('login', $data['login_sup']) == $data['login_sup']) {
        $errors[] = "Пользователь с таким логином уже есть";
    }

    // Если ошибок нет
    if (empty($errors)) {
        // хешируем пароль
        $passwordHash = password_hash($data['password_sup'], PASSWORD_DEFAULT);
        $user = User::insertUser($data['login_sup'], $passwordHash);
        $errors[] = "Вы успешно регистрированы. Прошу авторизоваться!";
        $_SESSION['state'] = false;
    }

}
