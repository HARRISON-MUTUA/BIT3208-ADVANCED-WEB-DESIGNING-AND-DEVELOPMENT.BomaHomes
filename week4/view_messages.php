<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'super_admin'){
    header("Location: login.php");
    exit();
}

include 'database/connection.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM contact_messages WHERE id = $id");
    header("Location: view_messages.php");
    exit();
}

if(isset($_GET['read'])){
    $id = $_GET['read'];
    mysqli_query($conn, "UPDATE contact_messages SET status = 'read' WHERE id = $id");
    header("Location: view_messages.php");
    exit();
}

$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");
$total = mysqli_num_rows($messages);
$unread = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM contact_messages WHERE status = 'unread'"))['count'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Messages - BomaHomes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #2d3436;
            margin: 0;
        }
        .header h1 span {
            color: #6c5ce7;
        }
        .stats {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .stat {
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
        }
        .stat .count {
            font-weight: 600;
            color: #2d3436;
        }
        .stat .label {
            color: #636e72;
        }
        .stat .unread {
            color: #e17055;
            font-weight: 600;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .nav-links a {
            background: #6c5ce7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
        }
        .nav-links a:hover {
            background: #5f3dc4;
        }
        .nav-links a.danger {
            background: #e17055;
        }
        .nav-links a.danger:hover {
            background: #d63031;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background: #f8f9fa;
        }
        table th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dfe6e9;
            font-weight: 600;
            color: #2d3436;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #f1f2f6;
        }
        table tbody tr:hover {
            background: #f8f9fa;
        }
        table tbody tr.unread {
            background: #fff3cd;
        }
        table tbody tr.unread:hover {
            background: #ffeaa7;
        }
        .badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-unread {
            background: #e17055;
            color: white;
        }
        .badge-read {
            background: #dfe6e9;
            color: #2d3436;
        }
        .badge-replied {
            background: #00b894;
            color: white;
        }
        .btn {
            padding: 5px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            border: none;
            cursor: pointer;
            display: inline-block;
            margin: 2px;
        }
        .btn-success {
            background: #00b894;
            color: white;
        }
        .btn-success:hover {
            background: #00a381;
        }
        .btn-danger {
            background: #e17055;
            color: white;
        }
        .btn-danger:hover {
            background: #d63031;
        }
        .btn-primary {
            background: #6c5ce7;
            color: white;
        }
        .btn-primary:hover {
            background: #5f3dc4;
        }
        .btn-back {
            background: #0984e3;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            transition: background 0.3s ease;
        }
        .btn-back:hover {
            background: #0770c4;
        }
        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #b2bec3;
        }
        .empty .icon {
            font-size: 64px;
            display: block;
            margin-bottom: 15px;
        }
        .empty h3 {
            color: #2d3436;
            margin-bottom: 10px;
        }
        .message-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .timestamp {
            font-size: 12px;
            color: #b2bec3;
        }
        .view-message {
            cursor: pointer;
            color: #6c5ce7;
            text-decoration: underline;
        }
        .view-message:hover {
            color: #5f3dc4;
        }
        .footer-actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f1f2f6;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }
        .modal-content h3 {
            color: #2d3436;
            margin-top: 0;
        }
        .modal-content .close {
            float: right;
            cursor: pointer;
            font-size: 24px;
            color: #b2bec3;
        }
        .modal-content .close:hover {
            color: #2d3436;
        }
        .modal-content .field {
            margin-bottom: 10px;
        }
        .modal-content .field .label {
            font-weight: 600;
            color: #636e72;
            font-size: 13px;
        }
        .modal-content .field .value {
            color: #2d3436;
        }
        .modal-content .message-full {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 5px;
            line-height: 1.6;
        }
        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        @media(max-width: 768px) {
            .container {
                padding: 20px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .stats {
                width: 100%;
            }
            table {
                font-size: 12px;
            }
            table th, table td {
                padding: 6px;
            }
            .message-preview {
                max-width: 80px;
            }
            .nav-links a {
                padding: 8px 14px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>📧 <span>Contact Messages</span></h1>
        <div class="stats">
            <div class="stat">
                <span class="count"><?php echo $total; ?></span>
                <span class="label">Total</span>
            </div>
            <div class="stat">
                <span class="unread"><?php echo $unread; ?></span>
                <span class="label">Unread</span>
            </div>
        </div>
    </div>

    <div class="nav-links">
        <a href="../week5/dashboard.php">📊 Dashboard</a>
        <a href="../week4/logout.php" class="danger">🚪 Logout</a>
    </div>

    <hr>

    <?php if($total > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($messages)): ?>
                <tr class="<?php echo $row['status'] == 'unread' ? 'unread' : ''; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['subject']); ?></td>
                    <td>
                        <div class="message-preview" title="<?php echo htmlspecialchars($row['message']); ?>">
                            <span class="view-message" onclick="viewMessage(<?php echo $row['id']; ?>, '<?php echo addslashes($row['name']); ?>', '<?php echo addslashes($row['email']); ?>', '<?php echo addslashes($row['subject']); ?>', '<?php echo addslashes($row['message']); ?>', '<?php echo $row['created_at']; ?>', <?php echo $row['status'] == 'unread' ? 'true' : 'false'; ?>)">
                                <?php echo htmlspecialchars(substr($row['message'], 0, 50)) . (strlen($row['message']) > 50 ? '...' : ''); ?>
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-<?php echo $row['status']; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="timestamp">
                            <?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?>
                        </span>
                    </td>
                    <td>
                        <?php if($row['status'] == 'unread'): ?>
                            <a href="view_messages.php?read=<?php echo $row['id']; ?>" class="btn btn-success">📖 Read</a>
                        <?php endif; ?>
                        <a href="view_messages.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Delete this message permanently?')">🗑️ Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty">
            <span class="icon">📭</span>
            <h3>No Messages Yet</h3>
            <p>When someone submits the contact form, their messages will appear here.</p>
            <br>
            <a href="contact.php" style="background: #6c5ce7; color: white; padding: 10px 25px; text-decoration: none; border-radius: 8px; display: inline-block;">
                📧 Go to Contact Page
            </a>
        </div>
    <?php endif; ?>

    <!-- Footer Actions -->
    <div class="footer-actions">
        <a href="../week5/dashboard.php" class="btn-back">← Back to Dashboard</a>
        <a href="contact.php" class="btn" style="background: #00b894; color: white; padding: 10px 25px; text-decoration: none; border-radius: 8px;">📧 New Message</a>
    </div>

</div>

<!-- View Message Modal -->
<div class="modal" id="messageModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>📄 Full Message</h3>
        <div class="field">
            <div class="label">From:</div>
            <div class="value" id="modalName"></div>
        </div>
        <div class="field">
            <div class="label">Email:</div>
            <div class="value" id="modalEmail"></div>
        </div>
        <div class="field">
            <div class="label">Subject:</div>
            <div class="value" id="modalSubject"></div>
        </div>
        <div class="field">
            <div class="label">Message:</div>
            <div class="message-full" id="modalMessage"></div>
        </div>
        <div class="field">
            <div class="label">Date:</div>
            <div class="value" id="modalDate"></div>
        </div>
        <div class="modal-actions">
            <a href="#" id="modalReadLink" class="btn btn-success" style="display:inline-block; padding: 8px 20px; text-decoration: none;">📖 Mark as Read</a>
            <a href="#" id="modalDeleteLink" class="btn btn-danger" style="display:inline-block; padding: 8px 20px; text-decoration: none;">🗑️ Delete</a>
            <button onclick="closeModal()" class="btn" style="background: #636e72; color: white; padding: 8px 20px; border: none; border-radius: 5px; cursor: pointer;">Close</button>
        </div>
    </div>
</div>

<script>
let currentMessageId = null;
let currentStatus = false;

function viewMessage(id, name, email, subject, message, date, isUnread) {
    currentMessageId = id;
    currentStatus = isUnread;
    
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalEmail').textContent = email;
    document.getElementById('modalSubject').textContent = subject;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modalDate').textContent = date;
    
    // Set action links
    let readLink = document.getElementById('modalReadLink');
    let deleteLink = document.getElementById('modalDeleteLink');
    
    if (isUnread) {
        readLink.href = 'view_messages.php?read=' + id;
        readLink.style.display = 'inline-block';
    } else {
        readLink.style.display = 'none';
    }
    
    deleteLink.href = 'view_messages.php?delete=' + id;
    
    document.getElementById('messageModal').classList.add('active');
}

function closeModal() {
    document.getElementById('messageModal').classList.remove('active');
}

// Close modal when clicking outside
window.onclick = function(event) {
    let modal = document.getElementById('messageModal');
    if (event.target == modal) {
        modal.classList.remove('active');
    }
}
</script>

</body>
</html>