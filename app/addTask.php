<?php
include_once "Models/Task.php";

$data = $_POST;
$login = $_SESSION['user'];

// Для случая, если страница только перезагружается
if(empty($data)){
    // Сюда запишем содержание с таблицы tasks
    $content = Task::showTaskAll($login);
}
/*
*  Добавляем задачу
*  Это блок подключается после авторизациии,
*  т.е в глобальном массиве $_SESSION логи пользователя
*/
if(isset($data['add-task'])){
    $errors = [];
    /*Добавляем статью */
    if(($data['description']) == ''){
        $errors[] = "Напишите задание";
    }
    if(empty($errors)){
        Task::addTask($login, $data['description']);
        $content = Task::showTaskAll($login);
    }
}

/* Удаляем все данные с таблицы tasks */
if(isset($data['delete-all'])){
    Task::deleteAll($login);
    /* Обнулим массив с содержанием задач */
    $content = [];
}

// Удаляем одну задачу
if(isset($data['delete-task'])){
    if (!$data['status']){
        $errors[] = "Выберите задачу для удаления";
    }else{
        Task::deleteTaskOne($login, $data['status']);
    }
    $content = Task::showTaskAll($login);

}

// Статус на все задачи - все выполнено
if(isset($data['ready-all'])){
    Task::statusConfirmAll($login);
    $content = Task::showTaskAll($login);
}
// Статус на одну задачу - выполнено/не выполнено
if(isset($data['ready-task'])){
    if(!$data['status']){
        $errors[] = "Выберите задачу для изменения";
    }else{
        Task::statusConfirmOne($login, $data['status']);
    }
    $content = Task::showTaskAll($login);
}

?>