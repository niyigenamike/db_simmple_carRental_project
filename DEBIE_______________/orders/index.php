<?php 
include_once("./connection/connection.php");

function validate_image($file){
    $ex_file = explode("?",$file)[0];
    if(!empty($ex_file)){
        if(is_file('allImages/'.$ex_file)){
            return 'allImages/'.$file;
        } else {
            return 'allImages/no-image-available.png';
        }
    } else {
        return 'allImages/no-image-available.png';
    }
}
?>

<div class="page">
    <div class="left">
        <h1>Orders</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Orders</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
    <a href="./?page=add_Order" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Add New Order</span>
    </a>
</div>

<?php if(isset($_GET['message']) && ($_GET['message'] == 'edit' || $_GET['message'] == 'insert')): ?>
    <div id="successMessage" class="success-message">Record <?php echo $_GET['message']; ?>ed successfully!</div>
<?php elseif(isset($_GET['message']) && $_GET['message'] == 'delete'): ?>
    <div id="successMessage" class="success-message">Record deleted successfully!</div>
<?php endif; ?>

<div class="DataTable">
    <div class="cardHeader">
        <h2>All Orders</h2>
        <a href="#" class="btn">View All</a>
    </div>

    <table>
        <thead>
            <tr>
                <td>Cnt</td>
                <td>Car ID</td>
                <td>Car Image</td>
                <td>Customer ID</td>
                <td>Customer Name</td>
                <td>Status</td>
                <td>Date</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php
            // Fetch data from the orders table
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            $x = 0;

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    $x++;
                    echo "<tr>";
                    echo "<td>".$x."</td>";
                    echo "<td>".$row["carId"]."</td>";
                    echo "<td><div class='image-container'><img src='".validate_image($row["carImage"])."' alt='Car Image'></div></td>";
                    echo "<td>".$row["customerId"]."</td>";
                    echo "<td>".$row["customerName"]."</td>";
                    echo "<td>".$row["status"]."</td>";
                    echo "<td>".$row["date"]."</td>";
                    
                    // Action buttons
                    echo "<td><a href='./?page=update_Order&id=".$row["id"]."'>Update</a> | ";
                    echo "<a href='delete_order.php?id=".$row["id"]."' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<style>
    .success-message {
        opacity: 1;
        background-color: lightgreen;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .image-container img {
        border-radius: 50%;
        width: 50px; /* Adjust size as needed */
        height: 50px; /* Adjust size as needed */
    }
</style>

<script>
    // JavaScript to hide success message after 3 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.opacity = '0';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 1000);
        }
    }, 3000);
</script>
