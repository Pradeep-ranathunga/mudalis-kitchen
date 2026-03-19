<?php include 'includes/header.php'; ?>

<div class="portfolio-container">
    <h1>Mudali's Masterpieces</h1>
    <p>Watch and Learn the Art of Cooking</p>
    
    <div class="video-grid">
        <?php
        include 'includes/db_connect.php';
        $sql = "SELECT * FROM recipes";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            // YouTube URL එක embed link එකක් බවට පත් කිරීම
            $url = $row['youtube_link'];
            $step1 = str_replace("watch?v=", "embed/", $url);
            $final_url = explode("&", $step1)[0]; 

            echo '<div class="video-card">';
            echo '<iframe src="'.$final_url.'" allowfullscreen></iframe>';
            echo '<h3>'.$row['title'].'</h3>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>