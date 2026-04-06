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
        background-color: rgba(239, 68, 68, 0.03); /* slight red tint for invoices */
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
    .btn-action-verify { background: #ECFDF5; color: #059669; }
    .btn-action-verify:hover { background: #059669; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2); }
    
    .btn-action-delete { background: #FEF2F2; color: #EF4444; }
    .btn-action-delete:hover { background: #EF4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); }
    
    .btn-danger-gradient {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        transition: all 0.3s ease;
    }
    .btn-danger-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
    }
    
    .amount-badge {
        font-family: 'Inter', monospace;
        font-weight: 700;
        color: #DC2626;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4 fade-in-up">
    <div>
        <p class="text-muted mb-0">Record and verify delivery invoices for pharmacy stock</p>
    </div>
    <a href="<?php echo base_url('invoices/create'); ?>" class="btn btn-danger btn-danger-gradient rounded-pill px-4 py-2 fw-500">
        <i class="bi bi-receipt me-2"></i> Log Invoice
    </a>
</div>

<div class="card glass-card fade-in-up" style="animation-delay: 0.1s;">
    <div class="card-body p-0 table-responsive border-0">
        <table class="table table-premium table-hover">
            <thead>
                <tr>
                    <th width="20%">Invoice Details</th>
                    <th width="20%">Supplier</th>
                    <th width="15%">Value</th>
                    <th width="15%">Status</th>
                    <th width="15%">Verification</th>
                    <th width="15%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($invoices)): foreach($invoices as $inv): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3 text-danger d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-file-earmark-text fs-5"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark mb-0 fs-6">#<?php echo $inv['invoice_number']; ?></strong>
                                <small class="text-muted"><?php echo date('d M Y', strtotime($inv['created_at'])); ?></small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-dark fw-500"><i class="bi bi-truck me-2 text-muted"></i><?php echo $inv['supplier_name']; ?></span>
                    </td>
                    <td>
                        <div class="amount-badge fs-5">£<?php echo number_format($inv['total_amount'], 2); ?></div>
                    </td>
                    <td>
                        <?php 
                        $statusClass = $inv['status'] == 'Checked' ? 'success' : 'danger';
                        $statusIcon = $inv['status'] == 'Checked' ? 'check-circle-fill' : 'exclamation-circle-fill';
                        ?>
                        <span class="badge bg-<?php echo $statusClass; ?> rounded-pill px-3 py-2 fw-normal shadow-sm">
                            <i class="bi bi-<?php echo $statusIcon; ?> me-1" style="font-size: 0.6rem;"></i> <?php echo $inv['status'] == 'Pending Verification' ? 'Pending' : $inv['status']; ?>
                        </span>
                    </td>
                    <td>
                        <?php if($inv['status'] == 'Checked'): ?>
                        <div class="text-muted fw-500 fs-7">
                            <i class="bi bi-person-check me-1"></i> <?php echo $inv['checked_by_name']; ?><br>
                            <small><i class="bi bi-clock me-1"></i> <?php echo date('d M H:i', strtotime($inv['checked_at'])); ?></small>
                        </div>
                        <?php else: ?>
                        <span class="text-muted fs-7 fst-italic">Awaiting check</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <?php if($inv['status'] != 'Checked'): ?>
                            <a href="<?php echo base_url('invoices/verify/'.$inv['id']); ?>" class="btn btn-action btn-action-verify" onclick="return confirm('Mark this invoice as verified and checked?');" data-bs-toggle="tooltip" title="Verify Invoice">
                                <i class="bi bi-check-lg fs-5"></i>
                            </a>
                            <?php else: ?>
                            <div class="btn btn-action bg-light text-success opacity-50 pe-none" data-bs-toggle="tooltip" title="Already Verified">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <?php endif; ?>
                            
                            <a href="<?php echo base_url('invoices/delete/'.$inv['id']); ?>" class="btn btn-action btn-action-delete" onclick="return confirm('Are you sure you want to permanently delete this record?');" data-bs-toggle="tooltip" title="Delete Invoice">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="opacity-50">
                            <i class="bi bi-receipt-cutoff display-1 mb-3 d-block text-muted"></i>
                            <h5 class="fw-normal">No pending invoices</h5>
                            <p class="mb-4">All delivery invoices have been verified.</p>
                            <a href="<?php echo base_url('invoices/create'); ?>" class="btn btn-outline-danger rounded-pill px-4">Log Invoice</a>
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
