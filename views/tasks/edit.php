<?php ob_start(); ?>
<h2>Edit Task</h2>

<?php if (empty($task)): ?>
    <p style="color:red">Task not found.</p>
<?php else: ?>
    <form method="post" action="/tasks/<?= $task['id'] ?>/update">
        <?= csrf_field() ?>
        <label>Title
            <input name="title" value="<?= htmlspecialchars($task['title'] ?? '') ?>">
        </label><br>

        <label>Description
            <textarea name="description"><?= htmlspecialchars($task['description'] ?? '') ?></textarea>
        </label><br>

        <label>Status
            <select name="status">
                <option value="pending" <?= ($task['status'] ?? '')=='pending'?'selected':'' ?>>Pending</option>
                <option value="in_progress" <?= ($task['status'] ?? '')=='in_progress'?'selected':'' ?>>In Progress</option>
                <option value="done" <?= ($task['status'] ?? '')=='done'?'selected':'' ?>>Done</option>
            </select>
        </label><br>

        <label>Due Date
            <input type="date" name="due_date" value="<?= htmlspecialchars($task['due_date'] ?? '') ?>">
        </label><br>

        <button>Save</button>
    </form>
<?php endif; ?>

<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
