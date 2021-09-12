<?php
$session = $_SESSION['user'];
if (isset($session)): ?>
    <div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100">
        <p><?php echo "Привет, " . $session; ?></p>
    </div>
    <div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100 hover:bg-green-200">
        <a href="/signout.php">Выйти</a>
    </div>
<?php else: ?>
    <div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100 hover:bg-green-200">
        <a href="/login.php">Log in</a>
    </div>
    <div class="inline-block px-3 py-2 rounded-lg border-2 bg-green-100 hover:bg-green-200">
        <a href="/signup.php">Log out</a>
    </div>
<?php endif; ?>
