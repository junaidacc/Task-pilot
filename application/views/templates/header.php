<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - TaskPilot' : 'TaskPilot'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --surface: rgba(255, 255, 255, 0.85);
            --bg: #F3F4F6;
            --text-main: #111827;
            --text-muted: #6B7280;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg); 
            background-image: radial-gradient(#E5E7EB 1px, transparent 1px);
            background-size: 20px 20px;
            color: var(--text-main);
        }
        
        .sidebar { 
            min-height: 100vh; 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255,255,255,0.5); 
            box-shadow: 4px 0 24px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .sidebar .nav-link { 
            color: var(--text-muted); 
            font-weight: 500; 
            padding: 0.8rem 1.2rem; 
            border-radius: 0.75rem;
            margin-bottom: 0.2rem;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            color: var(--primary);
            background: rgba(79, 70, 229, 0.05);
            transform: translateX(4px);
        }
        
        .sidebar .nav-link.active { 
            background-color: var(--primary); 
            color: white; 
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        
        .navbar-brand { 
            font-weight: 800; 
            color: var(--primary); 
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        
        .content-area { 
            padding: 2.5rem 3rem; 
            animation: fadeIn 0.5s ease forwards;
        }
        
        .card { 
            border: 1px solid rgba(255,255,255,0.4); 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01); 
            border-radius: 1rem; 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
            <div class="position-sticky">
                <a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <span class="fs-4 navbar-brand" style="color: var(--primary) !important;"><i class="bi bi-rocket-takeoff-fill me-2" style="animation: pulse 2s infinite;"></i> TaskPilot<span style="font-weight: 300; font-size: 60%"> PRO</span></span>
                </a>
                <hr>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('tasks'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'tasks' ? 'active' : ''; ?>">
                            <i class="bi bi-check2-square me-2"></i> Tasks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('prescriptions'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'prescriptions' ? 'active' : ''; ?>">
                            <i class="bi bi-prescription2 me-2"></i> Prescriptions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('claims'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'claims' ? 'active' : ''; ?>">
                            <i class="bi bi-file-earmark-medical me-2"></i> Service Claims
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('invoices'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'invoices' ? 'active' : ''; ?>">
                            <i class="bi bi-receipt me-2"></i> Invoices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('bugs'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'bugs' ? 'active' : ''; ?>">
                            <i class="bi bi-bug me-2"></i> Bugs / Notes
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong><i class="bi bi-person-circle fs-5 me-2"></i> <?php echo $this->session->userdata('user_name'); ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content-area">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?php echo $title; ?></h1>
            </div>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" style="border-radius: 0.75rem; border:none; background:#ECFDF5; color:#065F46;" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" style="border-radius: 0.75rem; border:none; background:#FEF2F2; color:#DC2626;" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
