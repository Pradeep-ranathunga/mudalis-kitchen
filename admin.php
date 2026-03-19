<?php 
include 'includes/db_connect.php'; 
session_start();

// Admin Login පරීක්ෂාව
if(!isset($_SESSION['admin_user'])){ 
    header("Location: login.php"); 
    exit(); 
}

// 1. Recipe එකතු කිරීමේ Logic එක
if(isset($_POST['add_recipe'])){
    $title = $conn->real_escape_string($_POST['title']);
    $link = $conn->real_escape_string($_POST['youtube_link']);
    $desc = $conn->real_escape_string($_POST['description']);
    $conn->query("INSERT INTO recipes (title, youtube_link, description) VALUES ('$title', '$link', '$desc')");
    header("Location: admin.php?success=1");
}

// 2. Package එකතු කිරීමේ Logic එක
if(isset($_POST['add_package'])){
    $p_name = $conn->real_escape_string($_POST['p_name']);
    $p_price = $conn->real_escape_string($_POST['p_price']);
    $p_features = $conn->real_escape_string($_POST['p_features']);
    
    $target_dir = "assets/images/packages/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }

    $file_name = time() . '_' . basename($_FILES["p_image"]["name"]);
    $target_file = $target_dir . $file_name;

    if(move_uploaded_file($_FILES["p_image"]["tmp_name"], $target_file)){
        $conn->query("INSERT INTO packages (name, price, features, image_url) VALUES ('$p_name', '$p_price', '$p_features', '$target_file')");
        header("Location: admin.php?success=1");
    }
}

// 3. Delete Logic (Recipes & Packages)
if(isset($_GET['delete_id'])){ 
    $conn->query("DELETE FROM recipes WHERE id = ".(int)$_GET['delete_id']); 
    header("Location: admin.php"); 
}
if(isset($_GET['delete_pkg'])){ 
    $conn->query("DELETE FROM packages WHERE id = ".(int)$_GET['delete_pkg']); 
    header("Location: admin.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Mudali's Kitchen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root { --accent: #d35400; --bg: #050505; --card: #111; --sidebar: #0a0a0a; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: var(--bg); color: #fff; display: flex; }
        
        /* Sidebar Styles */
        .sidebar { width: 250px; background: var(--sidebar); height: 100vh; position: fixed; border-right: 1px solid #222; padding: 30px 20px; }
        .sidebar h2 { color: var(--accent); font-family: 'Playfair Display', serif; margin-bottom: 40px; }
        .nav-item { padding: 15px; color: #888; text-decoration: none; display: block; border-radius: 10px; margin-bottom: 5px; transition: 0.3s; cursor: pointer; }
        .nav-item:hover, .nav-item.active { background: #1a1a1a; color: #fff; border-left: 4px solid var(--accent); }
        .nav-item i { margin-right: 10px; }

        /* Main Content */
        .main-content { margin-left: 290px; padding: 40px; width: calc(100% - 330px); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .admin-card { background: var(--card); padding: 25px; border-radius: 20px; border: 1px solid #222; margin-bottom: 30px; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        
        input, textarea { width: 100%; background: #1a1a1a; border: 1px solid #333; padding: 12px; margin: 10px 0; border-radius: 10px; color: #fff; box-sizing: border-box; }
        .btn-add { background: var(--accent); color: #fff; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: bold; width: 100%; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; color: #666; padding: 10px; border-bottom: 1px solid #222; font-size: 0.8rem; }
        td { padding: 15px 10px; border-bottom: 1px solid #111; font-size: 0.9rem; }
        .logout-btn { color: #ff4d4d; text-decoration: none; border: 1px solid #ff4d4d; padding: 8px 15px; border-radius: 8px; font-size: 0.8rem; }
        
        /* Animation */
        .admin-section { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Mudali Admin</h2>
    <a href="index.php" class="nav-item"><i class="fas fa-home"></i> Back to Site</a>
    <div class="nav-item active" onclick="showSection('recipes', this)"><i class="fas fa-utensils"></i> Manage Recipes</div>
    <div class="nav-item" onclick="showSection('packages', this)"><i class="fas fa-camera"></i> Manage Packages</div>
    <div class="nav-item" onclick="showSection('feedbacks', this)"><i class="fas fa-comment"></i> Feedbacks</div>
</div>

<div class="main-content">
    <div class="header">
        <h1>Welcome, <span style="color:var(--accent);"><?php echo $_SESSION['admin_user']; ?></span></h1>
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div id="recipes" class="admin-section">
        <div class="admin-card">
            <h2><i class="fas fa-utensils"></i> Manage Recipes</h2>
            <div class="dashboard-grid">
                <form action="admin.php" method="POST">
                    <input type="text" name="title" placeholder="Recipe Title" required>
                    <input type="text" name="youtube_link" placeholder="YouTube Link" required>
                    <textarea name="description" placeholder="Short Description"></textarea>
                    <button type="submit" name="add_recipe" class="btn-add">Add Recipe</button>
                </form>
                <div style="max-height: 400px; overflow-y: auto;">
                    <table>
                        <thead><tr><th>Title</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php $res = $conn->query("SELECT * FROM recipes ORDER BY id DESC");
                            while($row = $res->fetch_assoc()): ?>
                                <tr><td><?php echo $row['title']; ?></td>
                                <td><a href="admin.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')" style="color:#ff4d4d;"><i class="fas fa-trash"></i></a></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="packages" class="admin-section" style="display:none;">
        <div class="admin-card">
            <h2><i class="fas fa-camera"></i> Manage Photography Packages</h2>
            <div class="dashboard-grid">
                <form action="admin.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="p_name" placeholder="Package Name" required>
                    <input type="text" name="p_price" placeholder="Price" required>
                    <textarea name="p_features" placeholder="Features (comma separated)"></textarea>
                    <input type="file" name="p_image" accept="image/*" required>
                    <button type="submit" name="add_package" class="btn-add">Add Package</button>
                </form>
                <div style="max-height: 400px; overflow-y: auto;">
                    <table>
                        <thead><tr><th>Photo</th><th>Package</th><th>Action</th></tr></thead>
                        <tbody>
                            <?php $pkgs = $conn->query("SELECT * FROM packages ORDER BY id DESC");
                            while($p = $pkgs->fetch_assoc()): ?>
                                <tr><td><img src="<?php echo $p['image_url']; ?>" style="width:40px; border-radius:5px;"></td>
                                <td><?php echo $p['name']; ?></td>
                                <td><a href="admin.php?delete_pkg=<?php echo $p['id']; ?>" onclick="return confirm('Delete?')" style="color:#ff4d4d;"><i class="fas fa-trash"></i></a></td></tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="feedbacks" class="admin-section" style="display:none;">
        <div class="admin-card">
            <h2><i class="fas fa-comment"></i> Pending Feedbacks</h2>
            <table>
                <thead><tr><th>Client</th><th>Comment</th><th>Action</th></tr></thead>
                <tbody>
                    <?php $pending = $conn->query("SELECT * FROM feedbacks WHERE status='pending' ORDER BY id DESC");
                    while($fb = $pending->fetch_assoc()): ?>
                        <tr><td><?php echo $fb['name']; ?></td>
                        <td style="color:#888; font-style:italic;">"<?php echo $fb['comment']; ?>"</td>
                        <td><a href="approve_fb.php?id=<?php echo $fb['id']; ?>" style="color:#2ecc71; text-decoration:none; font-weight:bold;">Approve</a></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function showSection(sectionId, element) {
    // සියලුම Section සඟවන්න
    document.querySelectorAll('.admin-section').forEach(section => {
        section.style.display = 'none';
    });
    // තෝරාගත් Section එක පෙන්වන්න
    document.getElementById(sectionId).style.display = 'block';
    
    // Sidebar active class එක මාරු කරන්න
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');
}
</script>

</body>
</html>