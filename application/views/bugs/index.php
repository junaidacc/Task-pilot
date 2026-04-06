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
        background-color: rgba(75, 85, 99, 0.03); /* slight dark tint for bugs */
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
    .btn-action-edit { background: #F3F4F6; color: #4B5563; }
    .btn-action-edit:hover { background: #4B5563; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(75, 85, 99, 0.2); }
    
    .btn-dark-gradient {
        background: linear-gradient(135deg, #374151 0%, #111827 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(17, 24, 39, 0.3);
        transition: all 0.3s ease;
        color: white;
    }
    .btn-dark-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(17, 24, 39, 0.4);
        color: white;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
    <div>
        <p class="text-muted mb-0">Report system issues or add pharmacy operational notes</p>
    </div>
    <a href="<?php echo base_url('bugs/create'); ?>" class="btn btn-dark btn-dark-gradient rounded-pill px-4 py-2 fw-500">
        <i class="bi bi-bug me-2"></i> Report Issue
    </a>
</div>

<div class="card glass-card fade-in-up" style="animation-delay: 0.1s;">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-premium table-hover">
            <thead>
                <tr>
                    <th width="40%">Issue Details</th>
                    <th width="15%">Status</th>
                    <th width="20%">Reported By</th>
                    <th width="15%">Date</th>
                    <th width="10%" class="text-center">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($bugs)): foreach($bugs as $b): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-dark bg-opacity-10 rounded-circle p-2 me-3 text-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-journal-code fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark mb-1 fs-6"><?php echo $b['title']; ?></strong>
                                <small class="text-muted d-block line-clamp-1" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $b['description']; ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                        $badgeBg = 'secondary';
                        $badgeText = 'white';
                        
                        if($b['status'] == 'Open') { $badgeBg = 'danger'; }
                        if($b['status'] == 'In Progress') { $badgeBg = 'warning'; $badgeText = 'dark'; }
                        if($b['status'] == 'Resolved') { $badgeBg = 'success'; }
                        ?>
                        <span class="badge bg-<?php echo $badgeBg; ?> text-<?php echo $badgeText; ?> rounded-pill px-3 py-2 fw-normal shadow-sm">
                            <i class="bi bi-record-circle-fill me-1" style="font-size: 0.6rem;"></i> <?php echo $b['status']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="text-dark fw-500"><i class="bi bi-person-fill me-2 text-muted"></i><?php echo $b['reported_by_name']; ?></span>
                    </td>
                    <td>
                        <div class="text-muted fw-500 fs-7">
                            <i class="bi bi-calendar3 me-2"></i><?php echo date('d M Y', strtotime($b['created_at'])); ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url('bugs/edit/'.$b['id']); ?>" class="btn btn-action btn-action-edit" data-bs-toggle="tooltip" title="Update Status">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="bi bi-shield-check display-1 mb-3 d-block text-muted"></i>
                            <h5 class="fw-normal">No issues reported</h5>
                            <p class="mb-4">The system is running smoothly with no active reports.</p>
                            <a href="<?php echo base_url('bugs/create'); ?>" class="btn btn-outline-dark rounded-pill px-4">Log Note</a>
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
