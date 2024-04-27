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
        <h1>Order Cars</h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Order Cars</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#">Home</a>
            </li>
        </ul>
    </div>
</div>

<div class="carContainer">
    <?php
    // Fetch data from the cars table for available cars
    $sql = "SELECT * FROM cars WHERE availability = 'available'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='carCard'>";
            echo "<div class='carImage'><img src='".validate_image($row["image"])."' alt='Car Image'></div>";
            echo "<div class='carDetails'>";
            echo "<h2>".$row["carName"]."</h2>";
            echo "<p><strong>Car ID:</strong> ".$row["carId"]."</p>";
            echo "<p><strong>Year:</strong> ".$row["year_"]."</p>";
            echo "<p><strong>Transmission:</strong> ".$row["transmission"]."</p>";
            echo "<p><strong>Seats:</strong> ".$row["seats"]."</p>";
            echo "<p><strong>Price:</strong> ".$row["price"]."</p>";
            echo "<a href='order.php?carId=".$row["id"]."&carImage=".$row["image"]."&customerName=me&senderId=1' class='orderButton'>Order</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No available cars to display</p>";
    }
    ?>
</div>

<style>
    .carContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .carCard {
        width: 300px;
        background-color: #f5f5f5;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .carImage img {
        width: 100%;
        border-radius: 10px;
    }

    .carDetails {
        margin-top: 15px;
    }

    .carDetails h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .carDetails p {
        margin-bottom: 5px;
    }

    .orderButton {
        display: inline-block;
        padding: 8px 15px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .orderButton:hover {
        background-color: #0056b3;
    }
</style>
