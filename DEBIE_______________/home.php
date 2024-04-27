<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
//$store_url = "http://localhost/phpinventory/";
// db connection
$conn = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($conn->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Successfully connected";
}
// Check if studentId is set and not empty
function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.$url.'"</script>';
}
?><div class="cardBox">
    <?php
    require_once('Sections/homeCard.php');

    // Count total number of cars
    $sql_total_cars = "SELECT COUNT(*) AS total_cars FROM cars";
    $result_total_cars = $conn->query($sql_total_cars);
    $row_total_cars = $result_total_cars->fetch_assoc();
    $total_cars = $row_total_cars['total_cars'];

    // Count total number of available cars
    $sql_available_cars = "SELECT COUNT(*) AS available_cars FROM cars WHERE availability = 'available'";
    $result_available_cars = $conn->query($sql_available_cars);
    $row_available_cars = $result_available_cars->fetch_assoc();
    $available_cars = $row_available_cars['available_cars'];

    // Calculate the number of non-available cars
    $non_available_cars = $total_cars - $available_cars;

    // Call the function with the calculated values
    generateCard($total_cars, 'All Cars');
    generateCard($available_cars, 'Available');
    generateCard($non_available_cars, 'Not Available');
    ?>
</div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                 <?php include_once("Sections/recentOrders.php"); ?>

                <!-- ================= New Customers ================ -->
                <?php include_once("Sections/recentCustomers.php"); ?>
            </div>
        </div>
    </div>