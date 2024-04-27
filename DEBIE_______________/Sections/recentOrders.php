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
 
?><div class="recentOrders">
<div class="cardHeader">
    <h2>Recent Orders</h2>
    <a href="#" class="btn">View All</a>
</div>

<table>
    <thead>
        <tr>
            <td>Cnt</td>
            <td>Car Image</td>
            <td>User Name</td>
            <td>Status</td>
        </tr>
    </thead>

    <tbody>
        <?php
        // Fetch recent orders from the database
        $sql = "SELECT * FROM orders ORDER BY date DESC LIMIT 5"; // Assuming you want to display 5 recent orders
        $result = $conn->query($sql);
        $x = 0;

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $x++;
                echo "<tr>";
                echo "<td>".$x."</td>"; // Display the count
                echo "<td><img src='allImages/".$row["carImage"]."' alt='Car Image' style='width: 100px; height: 100px;'></td>"; // Display the carImage
                echo "<td>".$row["customerName"]."</td>"; // Display the customerName
                echo "<td>".$row["status"]."</td>"; // Display the status
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No recent orders found</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>
