<?php 
include_once("./connection/connection.php");

if (isset($_GET['carId'])) {
    // Retrieve data from the form
    $carId = $_GET["carId"];
    $carImage = $_GET["carImage"];
    $customerId = $_GET["customerId"];
    $customerName = $_GET["customerName"];
    $senderId = $_GET["senderId"];
    $status = $_GET["status"];
 
    // Insert data into the orders table
    $sql = "INSERT INTO orders (carId, carImage, customerId, customerName, senderId) 
            VALUES ('$carId', '$carImage', '$customerId', '$customerName', '$senderId')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the orders page with a success message
        header('location:./?page=orders&message=insert');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
