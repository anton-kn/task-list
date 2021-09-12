<?php
include_once __DIR__ . "../../../db/ConnectDB.php";
include_once "User.php";
/*
 * Класс предназначен для
 * записи, чтения, удаления заданий
 */
class Task
{
    /* метод для выполнения запроса к БД */
    private function connectDataBase($sql){
        $connect = new ConnectDB();
        /* Подготавливаем запрос */
//        $stmt = $connect->getConnect()->prepare($sql);
        $result = $connect->getConnect()->query($sql);
        $connect->closeConnect();
        return $result;
    }

    /*  Добавляем задачу */
    public static function addTask($nameLogin, $description)
    {
        /* Получаем id user */
        $userId = User::findUser('id', $nameLogin);
        /*Статус задачи */
        $status = false;
        $sql = "INSERT INTO tasks (user_id, description, status) VALUES ('".(int) $userId."', '".$description."', '"
            .(int) $status."')";
        /* Подключаемся к БД */
        return self::connectDataBase($sql);
    }
    /* Считываем все задачи */
    public static function showTaskAll($nameLogin)
    {
        /* Получаем id user */
        $userId = User::findUser('id', $nameLogin);
        $sql = "SELECT * FROM tasks WHERE user_id = $userId";
        $result = self::connectDataBase($sql);
        if($result == false){
            return self::connectDataBase($sql);
        }else {
            return self::connectDataBase($sql)->fetch_all();
        }
    }
    /* Удаляем все данные с таблицы tasks */
    public static function deleteAll($nameLogin)
    {
        $userId = User::findUser('id', $nameLogin);
        $sql = "DELETE FROM tasks WHERE user_id = $userId";
        return self::connectDataBase($sql);
    }

    public static function deleteTaskOne($nameLogin, $valueStatus)
    {
        $userId = User::findUser('id', $nameLogin);
        $sql = "DELETE FROM tasks WHERE user_id = $userId AND id = $valueStatus";
        return self::connectDataBase($sql);
    }


    /* Подтвержаем статус для всех задач - Выполнено */
    public static function statusConfirmAll($nameLogin)
    {
        $userId = User::findUser('id', $nameLogin);
        $sql = "UPDATE tasks SET status = true WHERE user_id = $userId";
        return self::connectDataBase($sql);
    }

    /* Подтвержаем статус для одной задачи - Выполнено  */
    public static function statusConfirmOne($nameLogin, $valueStatus)
    {
        $var = (int) $valueStatus;
        $userId = User::findUser('id', $nameLogin);
        $sql_1 = "SELECT status FROM tasks WHERE id = $var";
        $result = self::connectDataBase($sql_1);
        if($result == false){
            return self::connectDataBase($sql_1);
        }else {
            $status = self::connectDataBase($sql_1)->fetch_all();
            /* $status[0][0] - значение status из таблицы tasks */
            if ($status[0][0] == true){
                $sql_2 = "UPDATE tasks SET status = false WHERE user_id = $userId AND id = $valueStatus";
            }else{
                $sql_2 = "UPDATE tasks SET status = true WHERE user_id = $userId AND id = $valueStatus";
            }
            return self::connectDataBase($sql_2);
        }

    }

}
