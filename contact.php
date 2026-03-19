<?php include 'includes/header.php'; ?>

<main class="form-section">
    <div class="form-container">
        <h2>Get In Touch</h2>
        <form action="contact.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="message" placeholder="Your Message" rows="5"></textarea>
            <button type="submit" name="send" class="btn-submit">Send Message</button>
        </form>
    </div>
</main>


<?php include 'includes/footer.php'; ?>