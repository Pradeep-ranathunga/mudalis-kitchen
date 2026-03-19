<?php 
include 'includes/db_connect.php'; 
include 'includes/header.php'; 
?>

<section class="photo-hero" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('assets/img/photography-bg.jpg'); height: 65vh; display: flex; align-items: center; justify-content: center; text-align: center; background-size: cover; background-position: center;">
    <div class="hero-content">
        <h1 style="font-size: clamp(2.5rem, 8vw, 4.5rem); font-family: 'Playfair Display', serif; color: #fff; margin-bottom: 10px;">Robenso <span style="color:var(--accent);">Photography</span></h1>
        <p style="color: #ccc; font-size: 1rem; letter-spacing: 5px; text-transform: uppercase;">Capturing Life's Best Moments</p>
    </div>
</section>

<section class="gallery-section" style="padding: 80px 10%;">
    <h2 style="text-align: center; color: #fff; margin-bottom: 40px; font-family: 'Playfair Display', serif;">Our Portfolio</h2>
    <div class="photo-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px;">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552" alt="Wedding" style="width: 100%; border-radius: 10px; transition: 0.5s; cursor: pointer;" onmouseover="this.style.filter='grayscale(0%)'" onmouseout="this.style.filter='grayscale(50%)'">
        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc" alt="Couple" style="width: 100%; border-radius: 10px; transition: 0.5s; cursor: pointer;">
        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30" alt="Event" style="width: 100%; border-radius: 10px; transition: 0.5s; cursor: pointer;">
    </div>
</section>

<section class="pricing-section" style="padding: 80px 10%; background: #0a0a0a;">
    <h2 style="text-align: center; color: #fff; margin-bottom: 50px; font-family: 'Playfair Display', serif;">Investment & Packages</h2>
    <div class="package-container" style="display: flex; gap: 30px; justify-content: center; flex-wrap: wrap;">
        <?php
        $pkg_res = $conn->query("SELECT * FROM packages");
        if($pkg_res->num_rows > 0):
            while($pkg = $pkg_res->fetch_assoc()): ?>
                <div class="package-card" style="background: #161616; padding: 40px; border-radius: 20px; border: 1px solid #333; width: 350px; text-align: center; transition: 0.3s;">
                    <h3 style="color: var(--accent); font-size: 1.8rem;"><?php echo $pkg['name']; ?></h3>
                    <h2 style="color: #fff; margin: 20px 0;"><?php echo $pkg['price']; ?></h2>
                    <p style="color: #888; line-height: 1.6; min-height: 80px;"><?php echo $pkg['features']; ?></p>
                    <a href="contact.php" class="btn-submit" style="display: inline-block; margin-top: 25px; text-decoration: none;">BOOK NOW</a>
                </div>
        <?php endwhile; 
        else: echo "<p style='color:#666;'>No packages available at the moment.</p>";
        endif; ?>
    </div>
</section>

<section class="feedback-display" style="padding: 80px 10%;">
    <h2 style="text-align: center; color: #fff; margin-bottom: 40px; font-family: 'Playfair Display', serif;">What Our Clients Say</h2>
    <div class="feedback-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        <?php
        $fb_res = $conn->query("SELECT * FROM feedbacks WHERE status='approved' ORDER BY id DESC");
        while($fb = $fb_res->fetch_assoc()): ?>
            <div class="fb-card" style="background: rgba(255,255,255,0.03); padding: 30px; border-radius: 15px; border-left: 4px solid var(--accent);">
                <div class="stars" style="color: #f1c40f; margin-bottom: 10px;">
                    <?php 
                    $rating = $fb['rating'];
                    for($i=1; $i<=5; $i++) {
                        echo ($i <= $rating) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                    }
                    ?>
                </div>
                <p style="color: #aaa; font-style: italic; font-size: 0.95rem; line-height: 1.6;">"<?php echo $fb['comment']; ?>"</p>
                <h4 style="color: #fff; margin-top: 15px;">- <?php echo $fb['name']; ?></h4>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<section class="feedback-form-section" style="padding: 60px 10%; background: #0f0f0f; border-top: 1px solid #222;">
    <div style="max-width: 600px; margin: 0 auto; background: #161616; padding: 40px; border-radius: 20px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Leave a Review</h2>
        <form action="process_feedback.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required style="width: 100%; background: #222; border: 1px solid #333; padding: 15px; color: #fff; border-radius: 10px; margin-bottom: 15px;">
            
            <label style="color: #888; display: block; margin-bottom: 10px;">Your Rating:</label>
            <select name="rating" style="width: 100%; background: #222; border: 1px solid #333; padding: 15px; color: #fff; border-radius: 10px; margin-bottom: 15px;">
                <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                <option value="4">⭐⭐⭐⭐ - Very Good</option>
                <option value="3">⭐⭐⭐ - Good</option>
                <option value="2">⭐⭐ - Fair</option>
                <option value="1">⭐ - Poor</option>
            </select>

            <textarea name="comment" placeholder="Share your experience..." required rows="4" style="width: 100%; background: #222; border: 1px solid #333; padding: 15px; color: #fff; border-radius: 10px; margin-bottom: 20px;"></textarea>
            
            <button type="submit" name="submit_feedback" class="btn-submit" style="width: 100%;">SUBMIT REVIEW</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>