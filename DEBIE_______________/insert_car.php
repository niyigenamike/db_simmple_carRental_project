<?php 
include_once("./connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $carName = $_POST["carName"];
    $carId = $_POST["carId"];
    $year = $_POST["year"];
    $transmission = $_POST["transmission"];
    $seats = $_POST["seats"];
    $price = $_POST["price"];
    $availability = $_POST["availability"];

    // Check if ID is provided for updating
    if ($_POST['carId']!='Auto') {
        $id = $_POST['carId'];
        // Update data in the cars table
        $sql = "UPDATE cars SET carName='$carName', carId='$carId', year_='$year', transmission='$transmission', seats=$seats, price='$price', availability='$availability' WHERE id=$id";
    } else {
        // Retrieve image name if uploaded
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        // Insert data into the cars table
        $sql = "INSERT INTO cars (carName, carId, year_, transmission, seats, price, image, availability) 
                VALUES ('$carName', '$carId', '$year', '$transmission', $seats, '$price', '$image', '$availability')";
    }

    if ($conn->query($sql) === TRUE) {
        // Move uploaded image to 'allImages' folder if exists
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "allImages/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        // Redirect to the cars page
        if ($_POST['carId']!='Auto') {

        header('location:./?page=cars&message=edit');
        }else{
            header('location:./?page=cars&message=insert');

        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
