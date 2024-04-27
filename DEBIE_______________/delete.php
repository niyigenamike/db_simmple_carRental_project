<?php 
include_once("./connection/connection.php");

if (isset($_GET['table']) && isset($_GET['id']) && !isset($_GET['status'])) {
    $table = $_GET['table'];

    if ($table == 'cars') {
        $id = $_GET['id'];
        $sql = "DELETE FROM cars WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success message
            header('location:./?page=cars&message=delete');
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else if ($table == 'customer') {
        $id = $_GET['id'];
        $sql = "DELETE FROM customer WHERE id =$id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success message
            header('location:./?page=customers&message=delete');
        } else {
            echo "Error deleting record: " . $conn->error;
        }   
    } else if ($table == 'employees') {
        $id = $_GET['id'];
        $sql = "DELETE FROM employees WHERE id =$id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success message
            header('location:./?page=employees&message=delete');
        } else {
            echo "Error deleting record: " . $conn->error;
        }   
    }
} else if (isset($_GET['status'])) {
    $table = $_GET['table'];
    $status = $_GET['status'];
   
    if ($status == 'block') {
        if ($table == 'customer') {
            $id = $_GET['id'];
            $sql = "UPDATE customer SET status='non_active' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page with a success message
                header('location:./?page=customers');
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else if ($table == 'employees') {
            $id = $_GET['id'];
            $sql = "UPDATE employees SET status='non_active' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page with a success message
                header('location:./?page=employees');
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        if ($table == 'customer') {
            $id = $_GET['id'];
            $sql = "UPDATE customer SET status='active' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page with a success message
                header('location:./?page=customers');
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else if ($table == 'employees') {
            $id = $_GET['id'];
            $sql = "UPDATE employees SET status='active' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                // Redirect to the same page with a success message
                header('location:./?page=employees');
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
} else {
    // Do nothing
}
?>
