<?php ob_start(); ?>
<h2>Register</h2>
<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post" action="/register">
    <?= csrf_field() ?>
    <label>Name <input name="name"></label><br>
    <label>Email <input name="email"></label><br>
    <label>Password <input type="password" name="password"></label><br>
    <button>Register</button>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
