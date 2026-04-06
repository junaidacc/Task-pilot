<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border-radius: 1.25rem;
        overflow: hidden;
    }
    .table-premium {
        margin-bottom: 0;
    }
    .table-premium thead th {
        background: rgba(243, 244, 246, 0.7);
        border-bottom: 2px solid rgba(229, 231, 235, 0.5);
        color: #4B5563;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        padding: 1rem 1.5rem;
    }
    .table-premium tbody td {
        padding: 1.2rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        transition: background-color 0.2s ease;
    }
    .table-premium tbody tr:hover td {
        background-color: rgba(79, 70, 229, 0.02);
    }
    .btn-action {
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        border: none;
    }
    .btn-action-edit { background: #EEF2FF; color: #4F46E5; }
    .btn-action-edit:hover { background: #4F46E5; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2); }
    
    .btn-action-delete { background: #FEF2F2; color: #EF4444; }
    .btn-action-delete:hover { background: #EF4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); }
    
    .btn-primary-gradient {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        transition: all 0.3s ease;
    }
    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
    <div>
        <p class="text-muted mb-0">Manage and track all pharmacy operations</p>
    </div>
    <a href="<?php echo base_url('tasks/create'); ?>" class="btn btn-primary btn-primary-gradient rounded-pill px-4 py-2 fw-500">
        <i class="bi bi-plus-lg me-2"></i> Assign New Task
    </a>
</div>

<div class="card glass-card fade-in-up" style="animation-delay: 0.1s;">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-premium table-hover">
            <thead>
                <tr>
                    <th width="30%">Task Details</th>
                    <th width="20%">Assigned To</th>
                    <th width="15%">Status</th>
                    <th width="20%">Timeline</th>
                    <th width="15%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($tasks)): foreach($tasks as $task): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-3 text-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-card-checklist fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark mb-1 fs-6"><?php echo $task['title']; ?></strong>
                                <small class="text-muted d-block line-clamp-1" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $task['description']; ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php if($task['assigned_name']): ?>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    <?php echo strtoupper(substr($task['assigned_name'], 0, 1)); ?>
                                </div>
                                <span class="fw-500 text-dark"><?php echo $task['assigned_name']; ?></span>
                            </div>
                        <?php else: ?>
                            <span class="badge bg-light text-muted border px-3 py-2 rounded-pill fw-normal"><i class="bi bi-person-dash me-1"></i> Unassigned</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php 
                            $statusClass = 'secondary';
                            if($task['status'] == 'Completed') $statusClass = 'success';
                            if($task['status'] == 'In Progress') $statusClass = 'warning';
                        ?>
                        <span class="badge bg-<?php echo $statusClass; ?> text-<?php echo $statusClass=='warning'?'dark':'white'; ?> rounded-pill px-3 py-2 fw-normal shadow-sm">
                            <i class="bi bi-record-circle-fill me-1" style="font-size: 0.6rem;"></i> <?php echo $task['status']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="text-muted fw-500 fs-7">
                            <i class="bi bi-calendar3 me-2"></i><?php echo date('M d, Y', strtotime($task['created_at'])); ?><br>
                            <i class="bi bi-clock me-2"></i><?php echo date('h:i A', strtotime($task['created_at'])); ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="<?php echo base_url('tasks/edit/'.$task['id']); ?>" class="btn btn-action btn-action-edit" data-bs-toggle="tooltip" title="Edit Task">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="<?php echo base_url('tasks/delete/'.$task['id']); ?>" class="btn btn-action btn-action-delete" onclick="return confirm('Are you sure you want to permanently delete this task?');" data-bs-toggle="tooltip" title="Delete Task">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="bi bi-clipboard-x display-1 mb-3 d-block text-muted"></i>
                            <h5 class="fw-normal">No tasks found</h5>
                            <p class="mb-4">Get started by creating your first task.</p>
                            <a href="<?php echo base_url('tasks/create'); ?>" class="btn btn-outline-primary rounded-pill px-4">Create Task</a>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
