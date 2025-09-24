<?php ob_start(); ?>
<h2>Login</h2>
<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post" action="/login">
    <?= csrf_field() ?>
    <label>Email <input name="email"></label><br>
    <label>Password <input type="password" name="password"></label><br>
    <button>Login</button>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
