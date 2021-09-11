<?php
$title = "Task list";
include_once __DIR__ . "/includes/header.php";
?>
<body>
    <div class="font-mono p-8 bg-gray-200 h-screen">
        <div class="inline-block bg-green-100 w-4/5 py-4 px-2 rounded-lg text-2xl">
            <p>Task-list</p>
        </div>
        <div class="inline-block text-center absolute right-3 bg-green-50 w-1/5 py-1 px-2 rounded-lg">
            <div class="inline-block px-2 py-1 rounded-lg border-2 border-light-green-1000 border-opacity-100 hover:bg-green-200">
                <a href="/login.php">Log in</a>
            </div>
            <div class="inline-block px-2 py-1 rounded-lg border-2 border-light-green-1000 border-opacity-100
            hover:bg-green-200">
                <a href="/signup.php">Log out</a>
            </div>
        </div>
        <?php ?>
    </div>
</body>

</html>