<div class="card max-w-lg mx-auto border-dark" style="max-width: 600px;">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><?php echo isset($bug) ? 'Update' : 'Report'; ?> System Issue or Note</h5>
    </div>
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form action="<?php echo isset($bug) ? base_url('bugs/edit/'.$bug['id']) : base_url('bugs/create'); ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title / Summary</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($bug) ? $bug['title'] : set_value('title'); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Detailed Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo isset($bug) ? $bug['description'] : set_value('description'); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Open" <?php echo (isset($bug) && $bug['status'] == 'Open') ? 'selected' : ''; ?>>Open (Needs Action)</option>
                    <option value="In Progress" <?php echo (isset($bug) && $bug['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Resolved" <?php echo (isset($bug) && $bug['status'] == 'Resolved') ? 'selected' : ''; ?>>Resolved (Fixed)</option>
                    <option value="Closed" <?php echo (isset($bug) && $bug['status'] == 'Closed') ? 'selected' : ''; ?>>Closed (No Action Needed)</option>
                </select>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="<?php echo base_url('bugs'); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-dark"><?php echo isset($bug) ? 'Update' : 'Submit'; ?></button>
            </div>
        </form>
    </div>
</div>
