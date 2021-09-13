<?php
session_start();
include_once __DIR__ . "../../app/Models/User.php";
$data = $_POST;
if(isset($data['login'])){
    /*
     * В этой переменной будем хранить состояние,
     * которое будет определять форму регистрации или авторизации
     * false - авторизацию
     * true - регистрация
     */
    $state = false;

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