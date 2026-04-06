<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaskPilot Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --surface: #ffffff;
            --bg: #F3F4F6;
            --text: #1F2937;
        }
        body { 
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
            font-family: 'Inter', sans-serif; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh;
            margin: 0;
            color: var(--text);
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            animation: slideUpFade 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .login-card { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); 
            border-radius: 1.5rem; 
            padding: 2.5rem; 
            position: relative;
            overflow: hidden;
        }
        
        /* Premium glowing orb effect behind the card */
        .login-wrapper::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: var(--primary);
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.2;
            z-index: -1;
            animation: pulse 4s ease-in-out infinite alternate;
        }

        .brand { 
            font-weight: 800; 
            color: var(--primary); 
            font-size: 2.2rem; 
            text-align: center; 
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: -1px;
        }
        
        .brand i {
            animation: float 3s ease-in-out infinite;
        }

        .subtitle {
            text-align: center;
            color: #6B7280;
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .form-floating {
            margin-bottom: 1.2rem;
        }

        .form-control {
            border: 2px solid #E5E7EB;
            border-radius: 0.75rem;
            padding: 1rem;
            height: 3.5rem;
            transition: all 0.3s ease;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: var(--primary);
            background-color: #F8FAFC;
        }
        
        .form-floating label {
            padding-left: 1.2rem;
            color: #9CA3AF;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 0.75rem;
            padding: 0.8rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        /* Animations */
        @keyframes slideUpFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.1; }
            100% { transform: scale(1.2); opacity: 0.3; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="brand">
            <i class="bi bi-rocket-takeoff-fill"></i> TaskPilot
        </div>
        <div class="subtitle">Secure Pharmacy Operations</div>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" style="border-radius: 0.75rem; border: none; background: #FEF2F2; color: #DC2626;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo base_url('auth/login'); ?>" method="post">
            <div class="form-floating text-muted">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="email"><i class="bi bi-envelope me-2"></i>Email address</label>
            </div>
            <div class="form-floating text-muted">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Access Dashboard <i class="bi bi-arrow-right ms-2"></i></button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
