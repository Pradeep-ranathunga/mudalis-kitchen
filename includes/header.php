<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="Robenso Photography - Professional photography services for weddings, events, and portraits.">
<meta name="keywords" content="Robenso, Photography, Sri Lanka, Wedding Photography, Portrait, Mudali's Kitchen Photography">
<meta name="author" content="Mudali's Kitchen">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudali's Kitchen</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<nav>
    <div class="logo">
        <h2 style="color: #d35400; font-family: 'Playfair Display', serif;">Mudali's Kitchen</h2>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="portfolio.php">Recipes</a></li>
        <li><a href="contact.php">Contact</a></li>
        
       <?php if(isset($_SESSION['admin_user'])): ?>
        <li><a href="admin.php" style="color: #f1c40f;"><i class="fas fa-user-shield"></i> Admin</a></li>
    <?php endif; ?>
    </ul>
</nav>