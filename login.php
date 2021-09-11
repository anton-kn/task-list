<?php
$title = "Форма авторизации";
include_once __DIR__ . "/includes/header.php";
?>

<body>
    <div class="p-8 bg-gray-200 h-screen">
        <?php include_once __DIR__ . "/includes/backhome.php";?>
        <div class="w-50 p-2 text-center">
            <h1><?php echo $title;?></h1>
            <form class="" action="" method="post">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="login" placeholder="Введите login">
                <input class="mx-auto m-4 p-3 rounded-lg block" type="text" name="password" placeholder="Введите пароль">
                <button class="p-3 bg-green-400 rounded-lg" name="do_signup">Вход</button>
            </form>
        </div>
    </div>
</body>