<?php 
include_once("./connection/connection.php");

// Initialize variables to hold customer data if editing
$customerId = "Auto";
$fullName = "";
$email = "";
$address = "";
$phone = "";
$password = "";
$age = "";
$gender = "";
$status = "";
$image = "";

// Check if ID is provided for editing
if(isset($_GET['id'])) {
    $customerId = $_GET['id'];
    // Fetch customer data from the database
    $sql = "SELECT * FROM customer WHERE id = $customerId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign fetched data to variables
        $fullName = $row['cust_fullName'];
        $email = $row['cust_email'];
        $address = $row['cust_address'];
        $phone = $row['cust_phone'];
        $password = $row['cust_password'];
        $age = $row['cust_age'];
        $gender = $row['cust_gender'];
        $status = $row['status'];
        $image = $row['image'];
    }
}
?>

<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Customer' : 'Add New Customer'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Customers</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Customer' : 'Add New Customer'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="customerForm" action="insert_customer.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="customerId">Customer ID:</label>
            <input type="text" id="customerId" name="customerId" class="form-control" value="<?php echo $customerId; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" class="form-control" value="<?php echo $fullName; ?>">
            <div id="fullNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <div id="emailError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" class="form-control" value="<?php echo $address; ?>">
            <div id="addressError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $phone; ?>">
            <div id="phoneError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <div id="passwordError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" class="form-control" value="<?php echo $age; ?>">
            <div id="ageError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control">
                <option value="male" <?php if($gender == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if($gender == 'female') echo 'selected'; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control">
                <option value="active" <?php if($status == 'active') echo 'selected'; ?>>Active</option>
                <option value="non_active" <?php if($status == 'non_active') echo 'selected'; ?>>Non Active</option>
            </select>
            <div id="statusError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control">
            <div id="imageError" class="error-message"></div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-submit"><?php echo isset($_GET['id']) ? 'Update' : 'Submit'; ?></button>
            <button type="reset" class="btn-reset">Reset</button>
        </div>
    </form>
</div>

<script>
    document.getElementById("customerForm").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        var isValid = true;

        var fullName = document.getElementById("fullName").value.trim();
        var email = document.getElementById("email").value.trim();
        var address = document.getElementById("address").value.trim();
        var phone = document.getElementById("phone").value.trim();
        var password = document.getElementById("password").value.trim();
        var age = document.getElementById("age").value.trim();
        var status = document.getElementById("status").value;
        var image = document.getElementById("image").value;

        // Validate full name
        if (fullName === "") {
            document.getElementById("fullNameError").innerText = "Full Name is required";
            document.getElementById("fullName").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("fullNameError").innerText = "";
            document.getElementById("fullName").style.borderColor = "";
        }

        // Validate email
        if (email === "") {
            document.getElementById("emailError").innerText = "Email is required";
            document.getElementById("email").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("emailError").innerText = "";
            document.getElementById("email").style.borderColor = "";
        }

        // Validate address
        if (address === "") {
            document.getElementById("addressError").innerText = "Address is required";
            document.getElementById("address").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("addressError").innerText = "";
            document.getElementById("address").style.borderColor = "";
        }

        // Validate phone (should contain only numbers)
        if (!/^\d+$/.test(phone)) {
            document.getElementById("phoneError").innerText = "Phone should contain only numbers";
            document.getElementById("phone").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("phoneError").innerText = "";
            document.getElementById("phone").style.borderColor = "";
        }

        // Validate password
        if (password === "") {
            document.getElementById("passwordError").innerText = "Password is required";
            document.getElementById("password").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("passwordError").innerText = "";
            document.getElementById("password").style.borderColor = "";
        }

        // Validate age (should contain only numbers)
        if (!/^\d+$/.test(age)) {
            document.getElementById("ageError").innerText = "Age should contain only numbers";
            document.getElementById("age").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("ageError").innerText = "";
            document.getElementById("age").style.borderColor = "";
        }

        // Validate image file type (allow only image files)
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (image !== "" && !allowedExtensions.exec(image)) {
            document.getElementById("imageError").innerText = "Invalid file type. Please upload an image file (jpg, jpeg, png, gif).";
            document.getElementById("image").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("imageError").innerText = "";
            document.getElementById("image").style.borderColor = "";
        }

        // Validate status
        if (status === "") {
            document.getElementById("statusError").innerText = "Status is required";
            document.getElementById("status").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("statusError").innerText = "";
            document.getElementById("status").style.borderColor = "";
        }

        return isValid;
    }
</script>
