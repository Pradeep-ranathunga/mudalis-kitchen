<?php
include 'includes/db_connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Update the status from 'pending' to 'approved'
    $sql = "UPDATE feedbacks SET status = 'approved' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Feedback approved successfully!');
                window.location.href='admin.php';
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>