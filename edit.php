<?php
session_start();
$user= $_SESSION['user'];
if(!isset($user)){
    header("Location:admin_login.php");
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
        <h2>Update Home Page</h2>
        <?php
            if(isset($_POST['Submit_Update'])){
                include('includes/dbc_admin.php');
                $table = $_POST['table'];
                $id = $_POST['id'];
                $title = $_POST['title'];
                $message = $_POST['message'];
                $sql = "UPDATE $table SET title = '$title', message = '$message' WHERE id = '$id'";
                $result = mysqli_query($con, $sql);
                if($result!=0){
                    $msg = "<h2>Your content has successfully updated!</h2>";
                }//end if
            }//end if
            if(isset($msg)){
                echo $msg;
            }//end if
        ?>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <?php
                    $id = $_GET['id'];
                    $table = $_GET['table'];
                    include('includes/dbc_admin.php');
                    $sql = "SELECT * FROM $table WHERE id = '$id'";
                    $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo '<input type="hidden" name="id" value="'.$id.'">';
                echo '<input type="hidden" name="table" value="'.$table.'">';
                echo '<p><input type="text" name="title" value="'.$row['title'].'"></p>';
                echo '<p><textarea name="message" rows="20" cols="75">'.$row['message'].'</textarea></p>';					
            }//end while
    ?>
            <p><input type= "submit" name="Submit_Update" value= "Update"></p>
        </form>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
