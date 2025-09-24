<?php ob_start(); ?>
<h1>404 Not Found</h1>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
