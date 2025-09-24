<?php ob_start(); ?>
<h1>500 Internal Server Error</h1>
<p><?= htmlspecialchars($message ?? '') ?></p>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
