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
        background-color: rgba(16, 185, 129, 0.03); /* slight green tint for prescriptions */
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
    .btn-action-edit { background: #ECFDF5; color: #059669; }
    .btn-action-edit:hover { background: #059669; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2); }
    
    .btn-success-gradient {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        transition: all 0.3s ease;
    }
    .btn-success-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
    <div>
        <p class="text-muted mb-0">Manage repeated medication requests to GP Surgeries</p>
    </div>
    <a href="<?php echo base_url('prescriptions/create'); ?>" class="btn btn-success btn-success-gradient rounded-pill px-4 py-2 fw-500">
        <i class="bi bi-envelope-plus me-2"></i> New Request
    </a>
</div>

<div class="card glass-card fade-in-up" style="animation-delay: 0.1s;">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-premium table-hover">
            <thead>
                <tr>
                    <th width="25%">Patient details</th>
                    <th width="25%">GP Surgery</th>
                    <th width="15%">Status</th>
                    <th width="20%">Date & User</th>
                    <th width="15%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($prescriptions)): foreach($prescriptions as $p): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3 text-success d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-hearts fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark mb-0 fs-6"><?php echo $p['patient_name']; ?></strong>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-dark fw-500"><i class="bi bi-hospital me-2 text-muted"></i><?php echo $p['gp_surgery']; ?></span>
                    </td>
                    <td>
                        <?php 
                            $statusClass = 'secondary';
                            if($p['status'] == 'Completed') $statusClass = 'success';
                            if($p['status'] == 'Processed') $statusClass = 'info';
                            if($p['status'] == 'Pending') $statusClass = 'warning';
                        ?>
                        <span class="badge bg-<?php echo $statusClass; ?> text-<?php echo $statusClass=='warning'?'dark':'white'; ?> rounded-pill px-3 py-2 fw-normal shadow-sm">
                            <i class="bi bi-record-circle-fill me-1" style="font-size: 0.6rem;"></i> <?php echo $p['status']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="text-muted fw-500 fs-7">
                            <i class="bi bi-calendar3 me-2"></i><?php echo date('d M Y', strtotime($p['created_at'])); ?><br>
                            <i class="bi bi-person me-2"></i><?php echo $p['requested_by_name']; ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url('prescriptions/edit/'.$p['id']); ?>" class="btn btn-action btn-action-edit" data-bs-toggle="tooltip" title="Edit Request">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="bi bi-capsule display-1 mb-3 d-block text-muted"></i>
                            <h5 class="fw-normal">No prescription requests</h5>
                            <p class="mb-4">You have not submitted requests recently.</p>
                            <a href="<?php echo base_url('prescriptions/create'); ?>" class="btn btn-outline-success rounded-pill px-4">New Request</a>
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
