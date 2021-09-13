<?php
if (isset($session)): ?>
    <div class="my-2 p-2 bg-green-100 w-4/5 rounded-lg text-1xl">
        <p class="text-center">Список задач</p>
        <p class="text-center text-red-700"><?php echo array_shift($errors) ?></p>
        <div class="mx-auto w-96">
            <div class="mb-10 border-b-2 border-green-600">
                <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                    <input class="w-60 h-10 rounded-lg" type="text" name="description" placeholder="Введите задачу">
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="add-task">Добавить</button>
                </form>
                <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="delete-all">Удалить
                        все</button>
                    <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg" name="ready-all">Отметить
                        все</button>
                </form>
            </div>
            <?php if(!empty($content)): ?>
                <?php foreach ($content as $task): ?>
                <!-- $task[2] - это содержание задачи description из таблицы tasks -->
                <!-- $task[4] - это содержание status  из таблицы tasks -->
                <div class="p-4 border border-gray-900">
                    <p><?php echo $task[2] ?></p>
                    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                        <button class="my-2 p-2 bg-green-200 hover:bg-green-300 rounded-lg"
                                name="delete-task">Удалить</button>
                        <?php if($task[4] == true): ?>
                        <button class="my-2 p-2 bg-green-300 hover:bg-green-400 rounded-lg"
                                name="ready-task">Выполнено</button>
                        <?php else: ?>
                        <button class="my-2 p-2 bg-red-300 hover:bg-red-400 rounded-lg" name="ready-task">Не
                        выполнено</button>
                        <?php endif; ?>
                        <input type="checkbox" name="status" value="<?php echo $task[0]?>" <?php echo ($task[4])
                            ? "checked" : false ; ?>>
                    </form>
                </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </div>

<?php endif;?>