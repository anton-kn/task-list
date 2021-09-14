<?php
session_start();
include_once __DIR__ . "/includes/header.php";
include_once __DIR__ . "/app/checkRegistration.php";
?>

<body>
    <div class="p-8 bg-gray-200 h-screen">
        <?php include_once __DIR__ . "/includes/backhome.php";?>
        <div class="w-50 p-2 text-center">
            <h1>Авторизация/Регистрация</h1>
            <p class="text-red-500"> <?php echo array_shift($errors) ?></p>
            <form action="/registration.php" method="post">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="login" placeholder="Введите login">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="password" name="password"
                       placeholder="Введите пароль">
                <button class="p-3 bg-green-400 rounded-lg" name="do_login">Вход</button>
            </form>
        </div>
    </div>
</body>