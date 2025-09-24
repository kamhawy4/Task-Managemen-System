<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Task App</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="/tasks">Tasks</a> | <a href="/logout">Logout</a>
    <?php else: ?>
        <a href="/login">Login</a> | <a href="/register">Register</a>
    <?php endif; ?>
</nav>

<div class="container">
    <?= $content ?>
</div>

</body>
</html>
