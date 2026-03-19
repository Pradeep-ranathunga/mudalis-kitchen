<?php include 'includes/db_connect.php'; ?>
 <?php
session_start();
if(!isset($_SESSION['admin_user'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add New Recipe</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .admin-form { max-width: 500px; margin: 50px auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
        .admin-form input, .admin-form textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; }
        .btn-submit { background: #d35400; color: white; border: none; cursor: pointer; font-weight: bold; }
    </style>                                                   
     <style>
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background: #222;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .logout-btn {
        background: #c0392b;
        color: white;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 0.9rem;
        transition: 0.3s;
    }
    .logout-btn:hover {
        background: #e74c3c;
    }
    .admin-container {
        max-width: 600px;
        margin: 50px auto;
    }
    .back-btn {
    background: #444;
    color: white;
    padding: 8px 15px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 0.9rem;
    transition: 0.3s;
}

.back-btn:hover {
    background: var(--accent); /* අපි කලින් හදපු තැඹිලි පාට */
    color: #fff;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1a1a1a;
    padding: 15px 25px;
    border-radius: 12px;
    border: 1px solid #333;
}
</style>
</head>
<body>                                                      

<div class="admin-header">
    <div>
        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Site</a>
        <span style="color: #fff; margin-left: 15px;">Logged in as: <strong><?php echo $_SESSION['admin_user']; ?></strong></span>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>
<div class="admin-form">
    <h2>Add New YouTube Recipe</h2>
    <form action="admin.php" method="POST">
        <input type="text" name="title" placeholder="Recipe Title (කෑමේ නම)" required>
        <input type="text" name="youtube_link" placeholder="YouTube Video Link (URL)" required>
        <textarea name="description" placeholder="Short Description (කෙටි විස්තරයක්)" rows="4"></textarea>
        <button type="submit" name="submit" class="btn-submit">Add to Portfolio</button>
    </form>

    <?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $link = $_POST['youtube_link'];
        $desc = $_POST['description'];

        $sql = "INSERT INTO recipes (title, youtube_link, description) VALUES ('$title', '$link', '$desc')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Recipe added successfully!</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</div>

<?php
// 1. Delete කිරීමේ logic එක
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM recipes WHERE id = $id";
    
    if($conn->query($delete_sql) === TRUE){
        echo "<script>alert('Recipe deleted successfully!'); window.location='admin.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// 2. දැනට තියෙන Recipes පෙන්වන ලැයිස්තුව
?>
<div class="admin-container" style="margin-top: 30px;">
    <h3 style="color: #fff; border-bottom: 2px solid var(--accent); padding-bottom: 10px;">Manage Your Recipes</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; color: #fff; background: var(--card-dark); border-radius: 10px; overflow: hidden;">
        <thead>
            <tr style="background: #222; text-align: left;">
                <th style="padding: 15px;">Title</th>
                <th style="padding: 15px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $fetch_sql = "SELECT * FROM recipes ORDER BY id DESC";
            $all_recipes = $conn->query($fetch_sql);
            
            if($all_recipes->num_rows > 0){
                while($row = $all_recipes->fetch_assoc()){
                    echo "<tr style='border-bottom: 1px solid #333;'>";
                    echo "<td style='padding: 15px;'>" . $row['title'] . "</td>";
                    echo "<td style='padding: 15px;'>
                            <a href='admin.php?delete_id=" . $row['id'] . "' 
                               onclick=\"return confirm('Are you sure you want to delete this?')\" 
                               style='color: #ff4d4d; text-decoration: none; font-weight: bold;'>
                               <i class='fas fa-trash'></i> Delete
                            </a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' style='padding: 15px; text-align: center;'>No recipes found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<section class="admin-container" style="margin-top: 50px; padding: 20px;">
    <h2 style="color: #fff; border-bottom: 2px solid var(--accent); padding-bottom: 10px;">Pending Client Feedbacks</h2>
    <table style="width: 100%; color: #fff; background: #1a1a1a; border-radius: 10px; margin-top: 20px; border-collapse: collapse;">
        <tr style="background: #222; text-align: left;">
            <th style="padding: 15px;">Name</th>
            <th style="padding: 15px;">Rating</th>
            <th style="padding: 15px;">Comment</th>
            <th style="padding: 15px;">Action</th>
        </tr>
        <?php
        $pending = $conn->query("SELECT * FROM feedbacks WHERE status='pending'");
        while($row = $pending->fetch_assoc()) {
            echo "<tr style='border-bottom: 1px solid #333;'>";
            echo "<td style='padding: 15px;'>".$row['name']."</td>";
            echo "<td style='padding: 15px;'>".$row['rating']." Stars</td>";
            echo "<td style='padding: 15px;'>".$row['comment']."</td>";
            echo "<td style='padding: 15px;'>
                    <a href='approve_fb.php?id=".$row['id']."' style='color: #2ecc71; text-decoration: none;'>Approve</a> | 
                    <a href='delete_fb.php?id=".$row['id']."' style='color: #e74c3c; text-decoration: none;'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</section>
</body>
</html>