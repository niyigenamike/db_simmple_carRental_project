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
    $salary = $_POST["salary"];
    $department = $_POST["department"];

    // Check if ID is provided for updating
    if ($_POST['employeeId'] != 'Auto') {
        $id = $_POST['employeeId'];
        // Update data in the employees table
        $sql = "UPDATE employees SET cust_fullName='$fullName', cust_email='$email', cust_address='$address', cust_phone='$phone', cust_password='$password', cust_age='$age', cust_gender='$gender', status='$status', salary='$salary', department='$department' WHERE id=$id";
    } else {
        // Retrieve image name if uploaded
        $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        // Insert data into the employees table
        $sql = "INSERT INTO employees (cust_fullName, cust_email, cust_address, cust_phone, cust_password, cust_age, cust_gender, status, salary, department, image) 
                VALUES ('$fullName', '$email', '$address', '$phone', '$password', '$age', '$gender', '$status', '$salary', '$department', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        // Move uploaded image to 'allImages' folder if exists
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "allImages/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        // Redirect to the employees page
        if ($_POST['employeeId'] != 'Auto') {
            header('location:./?page=employees&message=edit');
        } else {
            header('location:./?page=employees&message=insert');
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
