<?php 
include_once("./connection/connection.php");

$employeeId = "Auto";
$fullName = "";
$email = "";
$address = "";
$phone = "";
$password = "";
$age = "";
$gender = "";
$status = "";
$salary = "";
$department = "";
$image = "";

if(isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = $employeeId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullName = $row['cust_fullName'];
        $email = $row['cust_email'];
        $address = $row['cust_address'];
        $phone = $row['cust_phone'];
        $password = $row['cust_password'];
        $age = $row['cust_age'];
        $gender = $row['cust_gender'];
        $status = $row['status'];
        $salary = $row['salary'];
        $department = $row['department'];
        $image = $row['image'];
    }
}
?>

<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add New Employee'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Employees</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add New Employee'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="employeeForm" action="insert_employee.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="employeeId">Employee ID:</label>
            <input type="text" id="employeeId" name="employeeId" class="form-control" value="<?php echo $employeeId; ?>" readonly>
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
            <label for="salary">Salary:</label>
            <input type="text" id="salary" name="salary" class="form-control" value="<?php echo $salary; ?>">
            <div id="salaryError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <select id="department" name="department" class="form-control">
                <option value="driver" <?php if($department == 'driver') echo 'selected'; ?>>Driver</option>
                <option value="cleaner" <?php if($department == 'cleaner') echo 'selected'; ?>>Cleaner</option>
                <option value="accountant" <?php if($department == 'accountant') echo 'selected'; ?>>Accountant</option>
                <option value="secretary" <?php if($department == 'secretary') echo 'selected'; ?>>Secretary</option>
            </select>
            <div id="departmentError" class="error-message"></div>
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
    document.getElementById("employeeForm").addEventListener("submit", function(event) {
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
        var salary = document.getElementById("salary").value.trim();
        var department = document.getElementById("department").value.trim();
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

        // Validate salary (should contain only numbers)
        if (salary === "" || isNaN(salary)) {
            document.getElementById("salaryError").innerText = "Salary should contain only numbers";
            document.getElementById("salary").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("salaryError").innerText = "";
            document.getElementById("salary").style.borderColor = "";
        }

        // Validate department
        if (department === "") {
            document.getElementById("departmentError").innerText = "Department is required";
            document.getElementById("department").style.borderColor = "red";
            isValid = false;
        } else {
            document.getElementById("departmentError").innerText = "";
            document.getElementById("department").style.borderColor = "";
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

        return isValid;
    }
</script>
