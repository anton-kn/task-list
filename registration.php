<?php
session_start();
include_once __DIR__ . "/includes/header.php";
include_once __DIR__ . "/app/checkRegistration.php";
$titleLogin = "Форма авторизации";
$titleSignUp = "Форма регистрации";

/*
 * В этой переменной будем хранить состояние,
 * которое будет определять форму регистрации/авторизации
 * false - авторизация
 * true - регистрация
 */
$state = $_SESSION['state'];

?>

<body>
    <div class="p-8 bg-gray-200 h-screen">
        <?php include_once __DIR__ . "/includes/backhome.php";?>
        <div class="w-50 p-2 text-center">
            <h1><?php echo $state == true ? $titleSignUp : $titleLogin;?></h1>
            <p class="text-red-500"> <?php echo array_shift($errors) ?></p>
            <form action="/registration.php" method="post">
                <?php if($state == false): ?>
                <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="login" placeholder="Введите login">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="password" name="password"
                       placeholder="Введите пароль">
                <button class="p-3 bg-green-400 rounded-lg" name="do_login">Вход</button>
            <?php else: ?>
                <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="login_sup"
                       placeholder="Введите login">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="password" name="password_sup" placeholder="Введите пароль">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="password" name="password_sup_2" placeholder="Повторите пароль">
                <button class="p-3 bg-green-400 rounded-lg" name="signup">Зарегистрировать</button>
            <?php endif; ?>
            </form>
        </div>
    </div>
</body>