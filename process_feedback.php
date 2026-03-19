<?php
include 'includes/db_connect.php';

if (isset($_POST['submit_feedback'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $rating = (int)$_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    // Insert as 'pending' so Admin can review before it goes live
    $sql = "INSERT INTO feedbacks (name, rating, comment, status) VALUES ('$name', '$rating', '$comment', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Thank you! Your feedback has been submitted successfully. It will appear on the site once approved by the admin.');
                window.location.href='robenso.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>