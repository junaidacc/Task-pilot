<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border-radius: 1.25rem;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
        position: relative;
    }
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    .metric-icon {
        background: rgba(255, 255, 255, 0.2);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.8rem;
    }
    .bg-gradient-primary { background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%); }
    .bg-gradient-success { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    .bg-gradient-warning { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
    .bg-gradient-danger  { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }
    
    .list-group-item {
        background: transparent;
        border-color: rgba(0,0,0,0.05);
        transition: all 0.2s ease;
    }
    .list-group-item:hover {
        background: rgba(79, 70, 229, 0.03);
        padding-left: 1.5rem;
    }
    .action-btn {
        border-radius: 0.75rem;
        padding: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        display: flex;
        align-items: center;
    }
    .btn-create-task { background: #EEF2FF; color: #4F46E5; }
    .btn-create-task:hover { background: #4F46E5; color: white; transform: translateX(5px); }
    
    .btn-request-rx { background: #ECFDF5; color: #059669; }
    .btn-request-rx:hover { background: #059669; color: white; transform: translateX(5px); }
    
    .btn-report-bug { background: #FEF2F2; color: #DC2626; }
    .btn-report-bug:hover { background: #DC2626; color: white; transform: translateX(5px); }
</style>

<div class="row g-4 fade-in-up">
    <!-- Quick Stats -->
    <div class="col-md-3">
        <div class="card glass-card bg-gradient-primary text-white h-100">
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-normal mb-0 opacity-75">Total Tasks</h5>
                    <div class="metric-icon"><i class="bi bi-list-task"></i></div>
                </div>
                <h2 class="display-4 fw-bold mb-3"><?php echo count($tasks); ?></h2>
                <a href="<?php echo base_url('tasks'); ?>" class="text-white text-decoration-none d-flex align-items-center opacity-75 stretched-link">
                    <span class="me-2 text-sm fw-500">View All</span> <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card glass-card bg-gradient-success text-white h-100" style="animation-delay: 0.1s;">
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-normal mb-0 opacity-75">Prescriptions</h5>
                    <div class="metric-icon"><i class="bi bi-capsule"></i></div>
                </div>
                <h2 class="display-4 fw-bold mb-3"><?php echo count($prescriptions); ?></h2>
                <a href="<?php echo base_url('prescriptions'); ?>" class="text-white text-decoration-none d-flex align-items-center opacity-75 stretched-link">
                    <span class="me-2 text-sm fw-500">Manage</span> <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card glass-card bg-gradient-warning text-white h-100" style="animation-delay: 0.2s;">
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-normal mb-0 opacity-75">Claims</h5>
                    <div class="metric-icon"><i class="bi bi-file-earmark-medical"></i></div>
                </div>
                <h2 class="display-4 fw-bold mb-3"><i class="bi bi-activity"></i></h2>
                <a href="<?php echo base_url('claims'); ?>" class="text-white text-decoration-none d-flex align-items-center opacity-75 stretched-link">
                    <span class="me-2 text-sm fw-500">Track Claims</span> <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card glass-card bg-gradient-danger text-white h-100" style="animation-delay: 0.3s;">
            <div class="card-body position-relative">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-normal mb-0 opacity-75">Invoices</h5>
                    <div class="metric-icon"><i class="bi bi-receipt"></i></div>
                </div>
                <h2 class="display-4 fw-bold mb-3"><i class="bi bi-check2-all"></i></h2>
                <a href="<?php echo base_url('invoices'); ?>" class="text-white text-decoration-none d-flex align-items-center opacity-75 stretched-link">
                    <span class="me-2 text-sm fw-500">Verify Now</span> <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 fade-in-up" style="animation-delay: 0.4s;">
    <div class="col-md-7">
        <div class="card glass-card h-100">
            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold d-flex align-items-center text-dark">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Active Tasks Overview
                </h5>
            </div>
            <div class="card-body px-4">
                <?php if(!empty($tasks)): ?>
                    <ul class="list-group list-group-flush mt-2">
                        <?php $i = 0; foreach($tasks as $t): if($i++ >= 6) break; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-0 border-bottom">
                            <div class="d-flex align-items-center">
                                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background-color: var(--primary); margin-right: 15px;"></span>
                                <span class="fw-500 text-dark"><?php echo $t['title']; ?></span>
                            </div>
                            <?php 
                                $statusClass = 'secondary';
                                if($t['status'] == 'Completed') $statusClass = 'success';
                                if($t['status'] == 'In Progress') $statusClass = 'warning';
                            ?>
                            <span class="badge bg-<?php echo $statusClass; ?> text-<?php echo $statusClass=='warning'?'dark':'white'; ?> rounded-pill px-3 py-2 fw-normal">
                                <?php echo $t['status']; ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="text-center py-5 opacity-50">
                        <i class="bi bi-inbox fs-1 mb-3 d-block text-muted"></i>
                        <p class="mb-0">Your workspace is crystal clear. No active tasks.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-5 mt-4 mt-md-0">
        <div class="card glass-card h-100">
            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-lightning-charge me-2 text-warning"></i> Quick Actions</h5>
            </div>
            <div class="card-body px-4 d-flex flex-column justify-content-center">
                <div class="d-grid gap-3 my-3">
                    <a href="<?php echo base_url('tasks/create'); ?>" class="action-btn btn-create-task text-decoration-none shadow-sm">
                        <div class="bg-white p-2 rounded-3 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                            <i class="bi bi-plus-lg text-primary fs-5"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-bold">Assign New Task</div>
                            <small class="opacity-75">Delegate work to staff</small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                    </a>
                    
                    <a href="<?php echo base_url('prescriptions/create'); ?>" class="action-btn btn-request-rx text-decoration-none shadow-sm">
                        <div class="bg-white p-2 rounded-3 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                            <i class="bi bi-capsule text-success fs-5"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-bold">Request Repeat Rx</div>
                            <small class="opacity-75">Email GP surgeries</small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                    </a>
                    
                    <a href="<?php echo base_url('bugs/create'); ?>" class="action-btn btn-report-bug text-decoration-none shadow-sm">
                        <div class="bg-white p-2 rounded-3 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                            <i class="bi bi-bug text-danger fs-5"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-bold">Report an Issue</div>
                            <small class="opacity-75">Log system bugs or notes</small>
                        </div>
                        <i class="bi bi-chevron-right ms-auto opacity-50"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
