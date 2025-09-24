<?php ob_start(); ?>
<h2>Create Task</h2>
<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post" action="/tasks">
    <?= csrf_field() ?>
    <label>Title <input name="title"></label><br>
    <label>Description <textarea name="description"></textarea></label><br>
    <label>Status
        <select name="status">
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
        </select>
    </label><br>
    <label>Due Date <input type="date" name="due_date"></label><br>
    <button>Create</button>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
