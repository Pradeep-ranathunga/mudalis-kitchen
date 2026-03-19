<?php
// 1. Session එක සහ Logic එක හැමදේටම කලින් තියෙන්න ඕනේ
session_start();
include 'includes/db_connect.php';

$error = ""; // Error එක store කරන්න variable එකක්

if(isset($_POST['login'])){
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM admin_users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['admin_user'] = $user;
        // Redirect එක සාර්ථකව වෙන්න නම් මෙතනින් පසු කිසිම code එකක් වැඩ නොකරන්න exit() දාන්න
        header("Location: admin.php");
        exit();
    } else {
        $error = "වැරදි නමක් හෝ මුරපදයක්!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Mudali's Kitchen</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .login-page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #0f0f0f;
        }
        .login-nav-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 8%;
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid #222;
        }
        .back-btn-styled {
            background: #222;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
            border: 1px solid #444;
        }
        .back-btn-styled:hover { background: var(--accent); border-color: var(--accent); }
        .login-main-section { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 10%; }
        .split-layout { display: flex; align-items: center; gap: 80px; width: 100%; max-width: 1100px; }
        @media (max-width: 900px) { .split-layout { flex-direction: column; text-align: center; gap: 40px; } }
    </style>
</head>
<body class="login-page-container">

    <nav class="login-nav-custom">
        <div class="logo">
            <h2 style="color: #d35400; font-family: 'Playfair Display', serif; margin: 0;">Mudali's Kitchen</h2>
        </div>
        <a href="index.php" class="back-btn-styled">
            <i class="fas fa-arrow-left"></i> &nbsp; BACK TO SITE
        </a>
    </nav>

    <main class="login-main-section">
        <div class="split-layout">
            <div class="info-side">
                <h1 style="font-size: 4rem; color: #fff; line-height: 1.1; margin-bottom: 20px;">
                    System <br><span style="color:var(--accent);">Access</span>
                </h1>
                <p style="color: #888; font-size: 1.1rem; max-width: 400px;">
                    Please enter your administrator credentials to continue to the dashboard.
                </p>
            </div>

            <div class="form-side" style="width: 100%; max-width: 450px;">
                <div class="form-container" style="background:#161616; padding: 45px; border-radius: 25px; border: 1px solid #222; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
                    <h2 style="color:#fff; text-align: center; margin-bottom: 30px; font-weight: 400;">Admin Login</h2>
                    <form method="POST">
                        <input type="text" name="username" placeholder="Username" required style="background:#222; color:#fff; border:1px solid #333; margin-bottom: 15px;">
                        <input type="password" name="password" placeholder="Password" required style="background:#222; color:#fff; border:1px solid #333; margin-bottom: 20px;">
                        <button type="submit" name="login" class="btn-submit" style="height: 55px; letter-spacing: 1px;">LOGIN</button>
                    </form>
                    <?php if(!empty($error)) echo "<p style='color:#ff4d4d; text-align:center; margin-top:20px; font-size: 0.9rem;'>$error</p>"; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>