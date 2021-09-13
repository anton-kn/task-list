<?php
session_start();
include_once __DIR__ . "../../app/Models/User.php";
$data = $_POST;

/*
 * В этой переменной будем хранить состояние,
 * которое будет определять форму регистрации или авторизации
 * false - авторизацию
 * true - регистрация
 */
$state = false;

/* авторизация */
if(isset($data['login'])){

    $errors = [];
    if (trim($data['login']) == ''){
        $errors[] = "Введите login";
    }
    if (trim($data['password']) == ''){
        $errors[] = "Введите password";
    }
    $user = User::findUser('login', $data['login']);
    echo $user;
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
        $state = true;
    }
}


/* Регистрация */
if (isset($data['signup'])) {
//    записываем успешную запись в БД
    $log = [];
//    записываем ошибки при проверке
    $errors = [];
    if (trim($data['login']) == '') {
        $errors[] = "Введите login";
    }
    if (trim($data['password']) == '') {
        $errors[] = "Введите password";
    }
    if (trim($data['password_2']) == '') {
        $errors[] = "Введите password";
    }

//    cравниваем пароли
    if ($data['password'] != $data['password_2']) {
        $errors[] = "Пароли не совпадают";
    }

//   проверяем длины логина и пароля
    if (mb_strlen($data['login']) < 3 || mb_strlen($data['login']) > 20) {
        $errors[] = "Измените длину login";
    }

    if (mb_strlen($data['password']) < 4 || mb_strlen($data['password']) > 20) {
        $errors[] = "Измените длину пароля";
    }

//    проверяем на повторяемость логина из БД

    if (User::findUser('login', $data['login']) == $data['login']) {
        $errors[] = "Пользователь с таким логином уже есть";
    }

    // Если ошибок нет
    if (empty($errors)) {
        // хешируем пароль
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = User::insertUser($data['login'], $passwordHash);
        $log[] = 'Вы зарегистрированы. Можно <a class="underline" href ="/login.php">авторизоваться</a>';
    }

}
