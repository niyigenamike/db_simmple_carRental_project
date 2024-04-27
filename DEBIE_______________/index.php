<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php
if(!isset($_SESSION['id']))
{	
     header("Location: login.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental system</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .page {
            padding: 20px;
        }

        .left {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container2 {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #007bff;
            margin-right: 10px;
        }

        .btn-reset {
            background-color: #dc3545;
        }

        .btn-submit,
        .btn-reset {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-reset:hover {
            background-color: #c82333;
        }



.page {
    display: flex;
    flex-direction: column;
    background-color: #f4f4f4;
    padding: 20px;
}

.left {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.left h1 {
    font-size: 24px;
    margin: 0;
}

.breadcrumb {
    list-style: none;
    padding: 0;
    margin: 0;
}

.breadcrumb li {
    display: inline;
    font-size: 14px;
    color: #666;
}

.breadcrumb li i {
    margin: 0 5px;
}

.btn-download {
    display: flex;
    align-items: center;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-download:hover {
    background-color: #0056b3;
}

.DataTable {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.cardHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.cardHeader h2 {
    font-size: 20px;
    margin: 0;
}

.btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.btn:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #f8f9fa;
}

thead tr {
    border-bottom: 2px solid #dee2e6;
}

thead td {
    font-weight: bold;
    padding: 10px 0;
    text-align: left;
}

tbody tr {
    border-bottom: 1px solid #dee2e6;
}

tbody td {
    padding: 10px 0;
    text-align: left;
}

.status {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.delivered {
    background-color: #28a745;
    color: #fff;
}

.pending {
    background-color: #ffc107;
    color: #000;
}

.return {
    background-color: #dc3545;
    color: #fff;
}

.inProgress {
    background-color: #17a2b8;
    color: #fff;
}


</style>
</head>

<body>
<?php 
 $page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page_name = explode("/",$page)[count(explode("/",$page)) -1];
?>
    <!-- =============== Navigation ================ -->
 <?php include_once("Sections/sideBar.php") ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
 <?php 
        if(is_file($page.'.php')){
            include $page.'.php';
        }else{
            if(is_dir($page) && is_file($page.'/index.php')){
                include $page.'/index.php';
            }
			else{
                if($page=='add_Customer'){
                    include_once 'customers/'.$page.'.php';
                }else if($page=='add_Car'){
                   include_once 'cars/'.$page.'.php';
                }else if($page=='add_Employee'){
                    include_once 'employees/'.$page.'.php';
                }else if($page=='add_Order'){
                    include_once 'orders/'.$page.'.php';
                }
                else{
                echo '<h4 class="text-center fw-bolder">Page Not Found</h4>';
                }
            }
        }
?>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>