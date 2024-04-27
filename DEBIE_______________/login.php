<?php session_start(); 

?>
<html>
    <header>
        <title>Test Login</title>
    </header>
    <body>
	<?php 
include("connection/connection.php");

if(isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    if($user == "" ||  $pass == "") {
        echo "Either username or password field is empty.";
        echo "<br/>";
        echo "<a href='login.php'>Go back</a>";
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password='$pass'")
        or die("Could not execute the select query.");
        
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)) {
            $validuser = $row['username'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {
            echo "<center>";
            echo "<h4 style='color:red;'>Invalid username or password.</h4>";
            echo "<br/>";
            echo "<a href='login.php'>Go back</a>";
            echo "</center>";
        }

        if(isset($_SESSION['valid'])) {
            header('Location: index.php');          
        }
    }
} else {
?>
    <?php
}
?>

  
         <form class="form-login" method="post">
						<fieldset>
							<legend>
								Sign in to your account
							</legend>
							<p>
								Please enter your name and password to log in.<br />
								<span style="color:red;"><?php //echo $_SESSION['errmsg']; ?><?php //echo $_SESSION['errmsg']="";?></span>
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									 </span>
									 <a href="forgot-password.php">
									Forgot Password ?
								</a>
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>					
						</fieldset>
					</form>

     </body>
</html>