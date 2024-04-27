<?php 
include_once("./connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $status = $_POST["status"];

    // Check if ID is provided for updating
    if ($_POST['customerId'] != 'Auto') {
        $id = $_POST['customerId'];
        // Update data in the customer table
        $sql = "UPDATE customer SET cust_fullName='$fullName', cust_email='$email', cust_address='$address', cust_phone='$phone', cust_password='$password', cust_age='$age', cust_gender='$gender', status='$status' WHERE cust_id=$id";
    } else {
        // Retrieve image name if uploaded
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        // Insert data into the customer table
        $sql = "INSERT INTO customer (cust_fullName, cust_email, cust_address, cust_phone, cust_password, cust_age, cust_gender, status, image) 
                VALUES ('$fullName', '$email', '$address', '$phone', '$password', '$age', '$gender', '$status', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        // Move uploaded image to 'allImages' folder if exists
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "allImages/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        // Redirect to the customers page
        if ($_POST['customerId'] != 'Auto') {
            header('location:./?page=customers&message=edit');
        } else {
            header('location:./?page=customers&message=insert');
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
