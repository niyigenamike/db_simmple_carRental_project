<?php include_once("./connection/connection.php"); ?>
<?php 
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
        <h1>Cars</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Cars</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
    <a href="./?page=add_Car" class="btn-download">
        <i class='bx bxs-cloud-download'></i>
        <span class="text">Add New Car</span>
    </a>
</div>

<div class="DataTable">
    <div class="cardHeader">
        <h2>All Cars</h2>
        <a href="#" class="btn">View All</a>
    </div>
    <?php if(isset($_GET['message']) && ($_GET['message'] == 'edit' || $_GET['message'] == 'insert')): ?>
        <div id="successMessage" class="success-message">Record <?php echo $_GET['message']; ?>ed successfully!</div>
    <?php elseif(isset($_GET['message']) && $_GET['message'] == 'delete'): ?>
        <div id="successMessage" class="success-message">Record deleted successfully!</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <td>Cnt</td>
                <td>Car Name</td>
                <td>Car ID</td>
                <td>Year</td>
                <td>Transmission</td>
                <td>Seats</td>
                <td>Price</td>
                <td>Image</td>
                <td>Availability</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php
            // Fetch data from the cars table
            $sql = "SELECT * FROM cars ORDER BY id DESC";
            $result = $conn->query($sql);
            $x = 0;

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    $x++;
                    echo "<tr>";
                    echo "<td>".$x."</td>";
                    echo "<td>".$row["carName"]."</td>";
                    echo "<td>".$row["carId"]."</td>";
                    echo "<td>".$row["year_"]."</td>";
                    echo "<td>".$row["transmission"]."</td>";
                    echo "<td>".$row["seats"]."</td>";
                    echo "<td>".$row["price"]."</td>";
                    echo "<td><div class='image-container'><img src='".validate_image($row["image"])."' alt='Car Image'></div></td>";
                    
                    // Display availability with appropriate styling
                    if ($row["availability"] == "available") {
                        echo "<td class='available'>".$row["availability"]."</td>";
                    } else {
                        echo "<td class='not-available'>".$row["availability"]."</td>";
                    }
                    
                    // Action buttons
                    echo "<td>  <a href='./?page=add_Car&id=".$row["id"]."'>Update</a> | <a href='delete.php?table=cars&id=".$row["id"]."' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>"; // Action buttons

                     echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No records found</td></tr>";
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
    .available {
        background-color: #28a745;
        color: #fff;
    }
    .not-available {
        background-color: #dc3545;
        color: #fff;
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
