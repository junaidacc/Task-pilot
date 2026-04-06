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
        background-color: rgba(245, 158, 11, 0.03); /* slight warning/amber tint for claims */
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
    .btn-action-edit { background: #FFFBEB; color: #D97706; }
    .btn-action-edit:hover { background: #D97706; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2); }
    
    .btn-warning-gradient {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        border: none;
        color: white !important;
        box-shadow: 0 4px 15px rgba(217, 119, 6, 0.3);
        transition: all 0.3s ease;
    }
    .btn-warning-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(217, 119, 6, 0.4);
    }
    
    .amount-badge {
        font-family: 'Inter', monospace;
        font-weight: 700;
        color: #D97706;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
    <div>
        <p class="text-muted mb-0">Track and manage submitted pharmacy service claims</p>
    </div>
    <a href="<?php echo base_url('claims/create'); ?>" class="btn btn-warning btn-warning-gradient rounded-pill px-4 py-2 fw-500">
        <i class="bi bi-file-earmark-plus me-2"></i> New Claim
    </a>
</div>

<div class="card glass-card fade-in-up" style="animation-delay: 0.1s;">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-premium table-hover">
            <thead>
                <tr>
                    <th width="25%">Service & Patient</th>
                    <th width="15%">Value</th>
                    <th width="15%">Status</th>
                    <th width="20%">Submission Details</th>
                    <th width="15%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($claims)): foreach($claims as $c): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3 text-warning d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-file-medical fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark mb-0 fs-6"><?php echo $c['service_name']; ?></strong>
                                <small class="text-muted"><i class="bi bi-person me-1"></i> <?php echo $c['patient_identifier']; ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="amount-badge fs-5">£<?php echo number_format($c['amount'], 2); ?></div>
                    </td>
                    <td>
                        <?php 
                        $badgeBg = 'secondary';
                        $badgeText = 'white';
                        
                        if($c['status'] == 'Approved') { $badgeBg = 'success'; }
                        if($c['status'] == 'Processing') { $badgeBg = 'info'; }
                        if($c['status'] == 'Submitted') { $badgeBg = 'primary'; }
                        if($c['status'] == 'Rejected') { $badgeBg = 'danger'; }
                        if($c['status'] == 'Draft') { $badgeBg = 'secondary'; }
                        ?>
                        <span class="badge bg-<?php echo $badgeBg; ?> text-<?php echo $badgeText; ?> rounded-pill px-3 py-2 fw-normal shadow-sm">
                            <i class="bi bi-record-circle-fill me-1" style="font-size: 0.6rem;"></i> <?php echo $c['status']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="text-muted fw-500 fs-7">
                            <i class="bi bi-calendar3 me-2"></i><?php echo date('d M Y', strtotime($c['created_at'])); ?><br>
                            <i class="bi bi-person-badge me-2"></i><?php echo $c['created_by_name']; ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url('claims/edit/'.$c['id']); ?>" class="btn btn-action btn-action-edit" data-bs-toggle="tooltip" title="Edit Claim">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="bi bi-file-earmark-bar-graph display-1 mb-3 d-block text-muted"></i>
                            <h5 class="fw-normal">No claims recorded</h5>
                            <p class="mb-4">You have not submitted any service claims yet.</p>
                            <a href="<?php echo base_url('claims/create'); ?>" class="btn btn-outline-warning text-dark rounded-pill px-4">New Claim</a>
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
