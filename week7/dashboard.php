<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
    exit();
}

$role = $_SESSION['role'] ?? 'landlord';
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'] ?? 0;

include '../week4/database/connection.php';

if ($role === 'super_admin') {
    $total_landlords = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM landlords WHERE role='landlord'"))['count'] ?? 0;
    $total_tenants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM tenants"))['count'] ?? 0;
    
    $landlords_result = mysqli_query($conn, "SELECT * FROM landlords WHERE role='landlord' ORDER BY id DESC");
    
} else {
    $tenant_count = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT COUNT(*) as count FROM tenants WHERE landlord_id = $user_id
    "))['count'] ?? 0;
    
    $tenants_result = mysqli_query($conn, "
        SELECT * FROM tenants WHERE landlord_id = $user_id ORDER BY id DESC
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BomaHomes Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ===== ROLE BADGE ===== */
        .role-badge {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        
        .role-badge.super-admin {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .role-badge.landlord {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .role-badge i {
            margin-right: 8px;
        }
        
        /* ===== WELCOME HEADER ===== */
        .welcome-header {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .welcome-header h1 {
            color: #2d3436;
            font-size: 28px;
        }
        
        .welcome-header h1 i {
            color: #6c5ce7;
            margin-right: 10px;
        }
        
        .welcome-header .subtitle {
            color: #636e72;
            margin-top: 5px;
        }
        
        .welcome-header .subtitle i {
            margin-right: 5px;
        }
        
        /* ===== NAVIGATION ===== */
        .nav-bar {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .nav-bar .brand {
            font-size: 20px;
            font-weight: 700;
            color: #2d3436;
        }
        
        .nav-bar .brand span {
            color: #6c5ce7;
        }
        
        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            background: #6c5ce7;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-size: 13px;
        }
        
        .nav-links a:hover {
            background: #5f3dc4;
        }
        
        .nav-links a.contact {
            background: #00b894;
        }
        
        .nav-links a.contact:hover {
            background: #00a381;
        }
        
        .nav-links a.logout {
            background: #e17055;
        }
        
        .nav-links a.logout:hover {
            background: #d63031;
        }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card .stat-icon {
            font-size: 28px;
            margin-bottom: 8px;
            opacity: 0.7;
        }
        
        .stat-card .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #2d3436;
        }
        
        .stat-card .stat-label {
            color: #636e72;
            font-size: 13px;
            margin-top: 3px;
        }
        
        .stat-card.purple .stat-icon { color: #6c5ce7; }
        .stat-card.blue .stat-icon { color: #0984e3; }
        .stat-card.green .stat-icon { color: #00b894; }
        .stat-card.orange .stat-icon { color: #fdcb6e; }
        .stat-card.red .stat-icon { color: #e17055; }
        .stat-card.pink .stat-icon { color: #fd79a8; }
        
        /* ===== MAIN CARD ===== */
        .main-card {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        
        .main-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f2f6;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .main-card .card-header h3 {
            color: #2d3436;
            font-size: 18px;
        }
        
        .main-card .card-header h3 i {
            color: #6c5ce7;
            margin-right: 8px;
        }
        
        .main-card .card-header .badge-count {
            background: #6c5ce7;
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
        }
        
        /* ===== TABLE ===== */
        .table-responsive {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 600px;
        }
        
        table thead {
            background: #f8f9fa;
        }
        
        table th {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 2px solid #dfe6e9;
            font-weight: 600;
            color: #2d3436;
            font-size: 13px;
        }
        
        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f2f6;
            font-size: 13px;
        }
        
        table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .badge-status {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }
        
        .badge-status.active { background: #d4edda; color: #155724; }
        .badge-status.inactive { background: #f8d7da; color: #721c24; }
        .badge-status.paid { background: #d4edda; color: #155724; }
        .badge-status.overdue { background: #f8d7da; color: #721c24; }
        .badge-status.pending { background: #fff3cd; color: #856404; }
        
        /* ===== BUTTONS ===== */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }
        
        .btn i {
            margin-right: 6px;
        }
        
        .btn-primary { background: #6c5ce7; color: white; }
        .btn-primary:hover { background: #5f3dc4; }
        .btn-danger { background: #e17055; color: white; }
        .btn-danger:hover { background: #d63031; }
        .btn-warning { background: #fdcb6e; color: #2d3436; }
        .btn-warning:hover { background: #fdcb6e; opacity: 0.8; }
        .btn-success { background: #00b894; color: white; }
        .btn-success:hover { background: #00a381; }
        .btn-sm { padding: 4px 10px; font-size: 12px; }
        .btn-logout { background: #e17055; color: white; padding: 10px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; display: inline-block; }
        .btn-logout:hover { background: #d63031; transform: translateY(-2px); }
        
        /* ===== QUICK ACTIONS ===== */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .quick-action-card {
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-decoration: none;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .quick-action-card:hover {
            transform: translateY(-5px);
        }
        
        .quick-action-card i {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
        }
        
        .quick-action-card.green {
            background: linear-gradient(135deg, #00b894, #00cec9);
        }
        
        .quick-action-card.orange {
            background: linear-gradient(135deg, #fdcb6e, #f39c12);
        }
        
        .quick-action-card.blue {
            background: linear-gradient(135deg, #0984e3, #74b9ff);
        }
        
        .text-muted { color: #b2bec3; }
        .text-center { text-align: center; }
        .mt-20 { margin-top: 20px; }
        .mb-20 { margin-bottom: 20px; }
        
        /* ============================================================ */
        /* RESPONSIVE: TABLET (768px - 1023px)                          */
        /* ============================================================ */
        @media (max-width: 1023px) and (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .welcome-header h1 {
                font-size: 24px;
            }
            
            .role-badge {
                padding: 8px 14px;
                font-size: 12px;
            }
            
            .nav-links a {
                padding: 6px 12px;
                font-size: 12px;
            }
        }
        
        /* ============================================================ */
        /* RESPONSIVE: MOBILE (0 - 767px)                                */
        /* ============================================================ */
        @media (max-width: 767px) {
            body {
                padding: 10px;
            }
            
            .role-badge {
                position: relative;
                top: auto;
                right: auto;
                display: inline-block;
                margin-bottom: 15px;
                font-size: 12px;
                padding: 6px 14px;
            }
            
            .welcome-header {
                padding: 20px;
            }
            
            .welcome-header h1 {
                font-size: 20px;
            }
            
            .welcome-header .subtitle {
                font-size: 13px;
            }
            
            .nav-bar {
                flex-direction: column;
                align-items: stretch;
                padding: 15px;
            }
            
            .nav-bar .brand {
                text-align: center;
                font-size: 18px;
            }
            
            .nav-links {
                justify-content: center;
            }
            
            .nav-links a {
                padding: 6px 12px;
                font-size: 11px;
                flex: 1;
                text-align: center;
                min-width: 60px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-card .stat-number {
                font-size: 22px;
            }
            
            .stat-card .stat-icon {
                font-size: 22px;
            }
            
            .stat-card .stat-label {
                font-size: 11px;
            }
            
            .main-card {
                padding: 15px;
            }
            
            .main-card .card-header h3 {
                font-size: 15px;
            }
            
            .main-card .card-header .badge-count {
                font-size: 11px;
                padding: 3px 10px;
            }
            
            table {
                font-size: 12px;
                min-width: 500px;
            }
            
            table th, table td {
                padding: 6px 8px;
            }
            
            .btn {
                font-size: 12px;
                padding: 6px 12px;
            }
            
            .btn-sm {
                font-size: 10px;
                padding: 3px 8px;
            }
            
            .quick-actions {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            
            .quick-action-card {
                padding: 15px;
            }
            
            .quick-action-card i {
                font-size: 22px;
            }
            
            .quick-action-card strong {
                font-size: 13px;
            }
            
            .quick-action-card small {
                font-size: 11px;
            }
            
            .btn-logout {
                padding: 8px 20px;
                font-size: 13px;
            }
        }
        
        /* ============================================================ */
        /* RESPONSIVE: SMALL MOBILE (0 - 400px)                          */
        /* ============================================================ */
        @media (max-width: 400px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .nav-links a {
                font-size: 10px;
                padding: 5px 10px;
                min-width: 50px;
            }
            
            .welcome-header h1 {
                font-size: 17px;
            }
            
            .role-badge {
                font-size: 10px;
                padding: 4px 10px;
            }
            
            table {
                font-size: 11px;
                min-width: 400px;
            }
            
            table th, table td {
                padding: 4px 6px;
            }
        }
        
        /* ============================================================ */
        /* RESPONSIVE: LARGE SCREEN (1440px+)                            */
        /* ============================================================ */
        @media (min-width: 1440px) {
            .dashboard-container {
                max-width: 1400px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body>

<div class="dashboard-container">

    <!-- Role Badge -->
    <div class="role-badge <?php echo $role === 'super_admin' ? 'super-admin' : 'landlord'; ?>">
        <i class="fas fa-<?php echo $role === 'super_admin' ? 'crown' : 'user-tie'; ?>"></i>
        <?php echo $role === 'super_admin' ? 'Super Admin' : 'Landlord'; ?>
    </div>

    <!-- Welcome Header -->
    <div class="welcome-header">
        <h1>
            <i class="fas fa-home"></i> 
            Welcome, <?php echo htmlspecialchars($username); ?>!
        </h1>
        <div class="subtitle">
            <i class="fas fa-<?php echo $role === 'super_admin' ? 'globe-africa' : 'building'; ?>"></i>
            <?php echo $role === 'super_admin' 
                ? 'You have full access to manage all landlords and properties.' 
                : 'Manage your properties, tenants, and track payments.'; ?>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="nav-bar">
        <div class="brand">🏠 Boma<span>Homes</span></div>
        <div class="nav-links">
            <a href="../week3/index.php"><i class="fas fa-home"></i> Home</a>
            <a href="../week4/contact.php" class="contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="../week8/students.php"><i class="fas fa-user-graduate"></i> Students</a>
            <a href="../week4/logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <?php if ($role === 'super_admin'): ?>
            <div class="stat-card purple">
                <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
                <div class="stat-number"><?php echo $total_landlords; ?></div>
                <div class="stat-label">Total Landlords</div>
            </div>
            
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                <div class="stat-number"><?php echo $total_tenants; ?></div>
                <div class="stat-label">Total Tenants</div>
            </div>
            
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fas fa-home"></i></div>
                <div class="stat-number">0</div>
                <div class="stat-label">Total Properties</div>
            </div>
        <?php else: ?>
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
                <div class="stat-number"><?php echo $tenant_count; ?></div>
                <div class="stat-label">My Tenants</div>
            </div>
            
            <div class="stat-card red">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="stat-number">0</div>
                <div class="stat-label">Overdue Payments</div>
            </div>
            
            <div class="stat-card pink">
                <div class="stat-icon"><i class="fas fa-wallet"></i></div>
                <div class="stat-number">KSh 0.00</div>
                <div class="stat-label">Monthly Income</div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Table -->
    <div class="main-card">
        <div class="card-header">
            <h3>
                <i class="fas fa-<?php echo $role === 'super_admin' ? 'users' : 'list'; ?>"></i>
                <?php echo $role === 'super_admin' ? 'All Landlords' : 'My Tenants'; ?>
            </h3>
            <span class="badge-count">
                <i class="fas fa-database"></i> 
                <?php echo $role === 'super_admin' ? $total_landlords : $tenant_count; ?> records
            </span>
        </div>
        
        <div class="table-responsive">
            <?php if ($role === 'super_admin'): ?>
                <?php if (mysqli_num_rows($landlords_result) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($landlords_result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <span class="badge-status <?php echo $row['is_active'] ? 'active' : 'inactive'; ?>">
                                        <i class="fas fa-<?php echo $row['is_active'] ? 'check-circle' : 'times-circle'; ?>"></i>
                                        <?php echo $row['is_active'] ? 'Active' : 'Suspended'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit_landlord.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="toggle_landlord.php?id=<?php echo $row['id']; ?>" class="btn btn-<?php echo $row['is_active'] ? 'warning' : 'success'; ?> btn-sm" 
                                       onclick="return confirm('Are you sure you want to toggle this landlord\'s status?')">
                                        <i class="fas fa-<?php echo $row['is_active'] ? 'pause' : 'play'; ?>"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted text-center" style="padding: 20px;">
                        <i class="fas fa-info-circle"></i> No landlords registered yet.
                    </p>
                <?php endif; ?>
                
            <?php else: ?>
                <?php if (mysqli_num_rows($tenants_result) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Rent</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($tenants_result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                                <td>KSh <?php echo number_format($row['rent_amount'], 2); ?></td>
                                <td>
                                    <span class="badge-status <?php echo $row['payment_status']; ?>">
                                        <i class="fas fa-<?php echo $row['payment_status'] === 'paid' ? 'check-circle' : ($row['payment_status'] === 'overdue' ? 'exclamation-circle' : 'clock'); ?>"></i>
                                        <?php echo ucfirst($row['payment_status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="edit_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure you want to delete this tenant?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted text-center" style="padding: 20px;">
                        <i class="fas fa-info-circle"></i> No tenants added yet. 
                        <a href="add_tenant.php" class="btn btn-primary btn-sm" style="margin-left: 10px;">
                            <i class="fas fa-plus"></i> Add Your First Tenant
                        </a>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions (Landlord Only) -->
    <?php if ($role === 'landlord'): ?>
        <div class="quick-actions">
            <a href="add_tenant.php" class="quick-action-card green">
                <i class="fas fa-user-plus"></i>
                <strong>Add Tenant</strong>
                <small style="display: block; opacity: 0.8; margin-top: 5px;">Register new tenant</small>
            </a>
            
            <a href="view_tenants.php" class="quick-action-card blue">
                <i class="fas fa-eye"></i>
                <strong>View Tenants</strong>
                <small style="display: block; opacity: 0.8; margin-top: 5px;">View all your tenants</small>
            </a>
            
            <a href="#" class="quick-action-card orange">
                <i class="fas fa-file-invoice"></i>
                <strong>Reports</strong>
                <small style="display: block; opacity: 0.8; margin-top: 5px;">View income reports</small>
            </a>
        </div>
    <?php endif; ?>
    
    <!-- Logout Button -->
    <div class="text-center mt-20">
        <a href="../week4/logout.php" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

</div>

</body>
</html>