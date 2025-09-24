<?php ob_start(); ?>
<h2>Your Tasks</h2>
<a href="/tasks/create">Create Task</a>

<?php $tasks = $tasks ?? []; ?>
<?php $page = $page ?? 1; ?>

<table border="1" cellpadding="6">
    <tr><th>Title</th><th>Status</th><th>Due</th><th>Actions</th></tr>
    <?php if (!empty($tasks)): ?>
        <?php foreach ($tasks as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['title'] ?? '') ?></td>
                <td><?= htmlspecialchars($t['status'] ?? '') ?></td>
                <td><?= htmlspecialchars($t['due_date'] ?? '') ?></td>
                <td>
                    <a href="/tasks/<?= $t['id'] ?>/edit">Edit</a> |
                    <form method="post" action="/tasks/<?= $t['id'] ?>/delete" style="display:inline">
                        <?= csrf_field() ?>
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">No tasks found.</td></tr>
    <?php endif; ?>
</table>

<div>
    <?php if ($page > 1): ?>
        <a href="/tasks?page=<?= $page-1 ?>">Prev</a>
    <?php endif; ?>
    <a href="/tasks?page=<?= $page+1 ?>">Next</a>
</div>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
