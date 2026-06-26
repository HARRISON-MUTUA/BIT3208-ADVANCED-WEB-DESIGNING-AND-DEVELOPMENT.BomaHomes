<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../week4/login.php");
    exit();
}

include 'database/connection.php';

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "
    SELECT * FROM tenants WHERE landlord_id = $user_id ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Tenants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h2 {
            color: #2d3436;
            margin-bottom: 10px;
        }
        h2 i {
            color: #6c5ce7;
        }
        .subtitle {
            color: #636e72;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table thead {
            background: #f8f9fa;
        }
        table th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dfe6e9;
            font-weight: 600;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #f1f2f6;
        }
        table tbody tr:hover {
            background: #f8f9fa;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-paid { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-overdue { background: #f8d7da; color: #721c24; }
        .btn {
            padding: 5px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
        }
        .btn-primary { background: #6c5ce7; color: white; }
        .btn-danger { background: #e17055; color: white; }
        .btn-primary:hover, .btn-danger:hover { opacity: 0.8; }
        .back {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #6c5ce7;
            text-decoration: none;
        }
        .back:hover { text-decoration: underline; }
        .empty {
            text-align: center;
            color: #b2bec3;
            padding: 40px 0;
        }
        .empty i {
            font-size: 48px;
            display: block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-users"></i> My Tenants</h2>
    <p class="subtitle">View all tenants registered under your properties</p>

    <?php if(mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Rent (KSh)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                    <td><?php echo number_format($row['rent_amount'], 2); ?></td>
                    <td>
                        <span class="badge badge-<?php echo $row['payment_status']; ?>">
                            <?php echo ucfirst($row['payment_status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="delete_tenant.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Delete this tenant?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty">
            <i class="fas fa-user-slash"></i>
            <p>No tenants added yet.</p>
            <a href="add_tenant.php" class="btn btn-primary" style="padding: 10px 20px; font-size: 14px;">
                <i class="fas fa-plus"></i> Add Your First Tenant
            </a>
        </div>
    <?php endif; ?>

    <a href="dashboard.php" class="back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>
</body>
</html>