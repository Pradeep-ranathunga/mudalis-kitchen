<?php include 'includes/header.php'; ?>
<div class="portfolio-container" style="padding: 120px 10% 50px;">
    <h1 style="text-align: center; color: #fff;">Mudali's Masterpieces</h1>
    <div class="video-grid">
        <?php
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        $sql = "SELECT * FROM recipes";
        if($search != '') { $sql .= " WHERE title LIKE '%$search%'"; }
        $sql .= " ORDER BY id DESC";
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $url = $row['youtube_link'];
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            $video_id = $match[1] ?? '';
            $final_url = "https://www.youtube.com/embed/" . $video_id;

            echo '<div class="video-card">';
            echo '<div class="video-wrapper"><iframe src="'.$final_url.'" allowfullscreen></iframe></div>';
            echo '<h3>'.$row['title'].'</h3>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>