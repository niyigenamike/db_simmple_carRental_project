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
 
?><div class="recentCustomers">
<div class="cardHeader">
    <h2>Recent Customers</h2>
</div>

<table>
    <tbody>
        <?php
        // Fetch recent customers from the database
        $sql = "SELECT * FROM customer ORDER BY id DESC LIMIT 5"; // Assuming you want to display 5 recent customers
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td width='60px'>";
                echo "<div class='imgBx'><img src='allImages/".$row["image"]."' alt='Customer Image'></div>";
                echo "</td>";
                echo "<td>";
                echo "<h4>".$row["cust_fullName"]."<br><span>".$row["cust_email"]."</span></h4>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No recent customers found</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>
