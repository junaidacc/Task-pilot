<div class="card max-w-lg mx-auto" style="max-width: 600px;">
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?php echo isset($task) ? base_url('tasks/edit/'.$task['id']) : base_url('tasks/create'); ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($task) ? $task['title'] : set_value('title'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?php echo isset($task) ? $task['description'] : set_value('description'); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="assigned_to" class="form-label">Assign To</label>
                <select class="form-select" id="assigned_to" name="assigned_to">
                    <option value="">-- Unassigned --</option>
                    <?php foreach($staff as $s): ?>
                        <option value="<?php echo $s['id']; ?>" <?php echo (isset($task) && $task['assigned_to'] == $s['id']) ? 'selected' : ''; ?>>
                            <?php echo $s['name']; ?> (<?php echo $s['role']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Pending" <?php echo (isset($task) && $task['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="In Progress" <?php echo (isset($task) && $task['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo (isset($task) && $task['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?php echo base_url('tasks'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary"><?php echo isset($task) ? 'Update Task' : 'Save Task'; ?></button>
            </div>
        </form>
    </div>
</div>
