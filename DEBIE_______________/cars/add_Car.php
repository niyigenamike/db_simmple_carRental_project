<?php 
include_once("./connection/connection.php");

// Initialize variables to hold car data if editing
$carId = "Auto";
$carName = "";
$year = "";
$transmission = "";
$seats = "";
$price = "";
$image = "";
$availability = "";

// Check if ID is provided for editing
if(isset($_GET['id'])) {
    $carId = $_GET['id'];
    // Fetch car data from the database
    $sql = "SELECT * FROM cars WHERE id = $carId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign fetched data to variables
        $carName = $row['carName'];
        $year = $row['year_'];
        $transmission = $row['transmission'];
        $seats = $row['seats'];
        $price = $row['price'];
        $image = $row['image'];
        $availability = $row['availability'];
    }
}
?>

<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Car' : 'Add New Car'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Cars</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Car' : 'Add New Car'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="carForm" action="insert_car.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="carId">Car ID:</label>
            <input type="text" id="carId" name="carId" class="form-control" value="<?php echo $carId; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="carName">Car Name:</label>
            <input type="text" id="carName" name="carName" class="form-control" value="<?php echo $carName; ?>">
            <div id="carNameError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" class="form-control" value="<?php echo $year; ?>">
            <div id="yearError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission:</label>
            <select id="transmission" name="transmission" class="form-control">
                <option value="">Select</option>
                <option value="manual" <?php if($transmission == 'manual') echo 'selected'; ?>>Manual</option>
                <option value="automatic" <?php if($transmission == 'automatic') echo 'selected'; ?>>Automatic</option>
            </select>
            <div id="transmissionError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="seats">Seats:</label>
            <input type="number" id="seats" name="seats" class="form-control" value="<?php echo $seats; ?>">
            <div id="seatsError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" class="form-control" value="<?php echo $price; ?>">
            <div id="priceError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" class="form-control">
            <div id="imageError" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="availability">Availability:</label>
            <select id="availability" name="availability" class="form-control">
                <option value="">Select</option>
                <option value="available" <?php if($availability == 'available') echo 'selected'; ?>>Available</option>
                <option value="not_available" <?php if($availability == 'not_available') echo 'selected'; ?>>Not Available</option>
            </select>
            <div id="availabilityError" class="error-message"></div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-submit"><?php echo isset($_GET['id']) ? 'Update' : 'Submit'; ?></button>
            <button type="reset" class="btn-reset">Reset</button>
        </div>
    </form>
</div>

<script>
    document.getElementById("carForm").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        var isValid = true;

        var carName = document.getElementById("carName").value;
        var carNameError = document.getElementById("carNameError");
        if (carName.trim() === "") {
            carNameError.innerText = "Car Name is required";
            carNameError.style.color = "red";
            document.getElementById("carName").style.borderColor = "red";
            isValid = false;
        } else {
            carNameError.innerText = "";
            document.getElementById("carName").style.borderColor = "";
        }

        var year = document.getElementById("year").value;
        var yearError = document.getElementById("yearError");
        if (!/^\d{4}$/.test(year)) {
            yearError.innerText = "Invalid year format";
            yearError.style.color = "red";
            document.getElementById("year").style.borderColor = "red";
            isValid = false;
        } else {
            yearError.innerText = "";
            document.getElementById("year").style.borderColor = "";
        }

        var transmission = document.getElementById("transmission").value;
        var transmissionError = document.getElementById("transmissionError");
        if (transmission === "") {
            transmissionError.innerText = "Transmission is required";
            transmissionError.style.color = "red";
            document.getElementById("transmission").style.borderColor = "red";
            isValid = false;
        } else {
            transmissionError.innerText = "";
            document.getElementById("transmission").style.borderColor = "";
        }

        var seats = document.getElementById("seats").value;
        var seatsError = document.getElementById("seatsError");
        if (seats > 20) {
            seatsError.innerText = "Seats cannot exceed 20";
            seatsError.style.color = "red";
            document.getElementById("seats").style.borderColor = "red";
            isValid = false;
        } else {
            seatsError.innerText = "";
            document.getElementById("seats").style.borderColor = "";
        }

        var price = document.getElementById("price").value;
        var priceError = document.getElementById("priceError");
        if (price.trim() === "") {
            priceError.innerText = "Price is required";
            priceError.style.color = "red";
            document.getElementById("price").style.borderColor = "red";
            isValid = false;
        } else {
            priceError.innerText = "";
            document.getElementById("price").style.borderColor = "";
        }

        var image = document.getElementById("image").value;
        var imageError = document.getElementById("imageError");
        if (image === "") {
            imageError.innerText = "Image is required";
            imageError.style.color = "red";
            document.getElementById("image").style.borderColor = "red";
            isValid = false;
        } else {
            imageError.innerText = "";
            document.getElementById("image").style.borderColor = "";
        }

        var availability = document.getElementById("availability").value;
        var availabilityError = document.getElementById("availabilityError");
        if (availability === "") {
            availabilityError.innerText = "Availability is required";
            availabilityError.style.color = "red";
            document.getElementById("availability").style.borderColor = "red";
            isValid = false;
        } else {
            availabilityError.innerText = "";
            document.getElementById("availability").style.borderColor = "";
        }

        return isValid;
    }
</script>
