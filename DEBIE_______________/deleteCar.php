<?php 
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM cars WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the cars page with a success message
         header('location:./?page=cars&message=edit');

        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>