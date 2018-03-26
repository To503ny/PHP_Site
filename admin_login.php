<?php
session_start();
if(isset($_POST['Submit_Login'])) {
    $email = trim($_POST['email']);
    $pwd = md5(trim($_POST['pwd']));
    include('includes/dbc.php');
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pwd'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==0){
        $msg = '<h2 style ="color:red" ;>Invalid Credentials!</h2>';
    }else{
        $_SESSION['user'] = $email;
        $msg = '<h2>Login Successful!</h2>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <?php include('includes/header.inc'); ?>
    
    <?php include('includes/nav.inc'); ?>
    
<div id="wrapper">


	
    <?php include('includes/aside.inc'); ?>

	<section>
	   <h2>Admin Login</h2>
        <?php
            if(isset($msg)){
                echo $msg."<br>";
            }
        ?>
    <form method="post" name="form1" action="<?php $_SERVER['PHP_SELF']; ?>">
        <p>Email Address:<br> <input type="text" name="email"></p>
        <p>Password: <br><input type="password" name="pwd"></p>
        <p><input type="submit" name="Submit_Login" value = "Login"></p>    
    </form>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
