<?php 
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}
// Folder structure එකට අනුව path එක නිවැරදි කිරීම
include 'includes/db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudali's Kitchen</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav>
    <div class="logo">
        <h2 style="color: #d35400; font-family: 'Playfair Display', serif; margin: 0;">Mudali's Kitchen</h2>
    </div>

    <div class="header-search">
        <form action="portfolio.php" method="GET">
            <input type="text" name="search" placeholder="Search recipes..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="portfolio.php">Recipes</a></li>
        <li><a href="robenso.php">Photography</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        <?php if(isset($_SESSION['admin_user'])): ?>
            <li><a href="admin.php" style="color: #f1c40f;"><i class="fas fa-user-shield"></i> Admin</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div style="margin-top: 80px;"></div>