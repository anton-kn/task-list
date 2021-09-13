<?php
session_start();
$session = $_SESSION['user'];
$title = "Task list";
/*
 * При переходе на главную страницу сбрасываем S_SESSION['status'],
 * чтобы при повторном переходе появлялась форма авторизации
 */
include_once __DIR__ . "/includes/resetState.php";
?>

<?php include_once __DIR__ . "/includes/header.php"; ?>
<?php include_once __DIR__ . "/app/addTask.php"; ?>
<body>
    <div class="font-mono p-8 bg-gray-200 h-screen">
        <div class="inline-block bg-green-100 w-4/5 py-4 px-2 rounded-lg text-2xl">
            <p class="text-center">Task-list</p>
        </div>
        <?php include_once __DIR__ . "/includes/userprofile.php"; ?>
        <!-- Блок подключается, когда пользователь авторизоват -->
        <?php include_once __DIR__ . "/includes/tasklist.php"; ?>

    </div>
</body>

</html>