<?php
include 'includes/db_connect.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Delete the feedback record
    $sql = "DELETE FROM feedbacks WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Feedback deleted successfully!');
                window.location.href='admin.php';
              </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
$conn->close();
?>