<?php
session_start();
$cart = $_COOKIE['MyGameProducts'];
if (isset($_POST['clear'])){
    $expire = time() - 60*60*24*7*365;
    setcookie("MyGameProducts", $cart, $expire);
    header("Location:add_review.php");
}//end if
if($cart && $_GET['id']) {
    $cart = $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyGameProducts", $cart, $expire);
    header("Location:add_review.php");
}//end if
if(!$cart && $_GET['id']) {
    $cart .= $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyGameProducts", $cart, $expire);
    header("Location:add_review.php");
}//end if

if(isset($_POST['Submit_Review'])) {
    $id = $cart;
    $name = $_POST['theName'];
    $comments = $_POST['comments'];
    if($name=="") {
        $nameMsg = "<br><span style='color:red;'>Your name cannot be blank.</span>";
    }
    if($comments=="") {
        $commentMsg = "<br><span style='color:red;'>Their is not a message.</span>";
    }else {
        include('includes/dbc_admin.php');
        $query = "INSERT INTO reviews (product_id, name, comment) VALUES ('$id','$name','$comments')";
        $success = mysqli_query($con, $query);
        if($success) {
            $inserted = "<h2>Thanks for the review!</h2>";
        }else{
            $error_message = mysqli_error($con);
            $inserted = "There was an error: $error_message";
            exit($inserted);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
    function validateForm() {
        console.log("validateForm entered")
        var theName = document.form1.theName.value;
        var comment = document.form1.comments.value;
        var nameMsg = document.getElementById('nameMsg');
        var commentMsg = document.getElementById('commentMsg');
        if(theName == "") {nameMsg.innerHTML = "Your name cannot be blank."; return false;}
        if(comment == "") {commentMsg.innerHTML = "There is no commment to send!"; return false;}
    }
</script>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <?php include('includes/header.inc'); ?>
    
    <?php include('includes/nav.inc'); ?>
    
<div id="wrapper">


	
    <?php include('includes/aside.inc'); ?>

	<section>
        <h2>Leave A Review</h2>
        <?php if(isset($inserted)) {echo $inserted; } else { ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form1" onSubmit="return validateForm()">         
            <p>
               Product ID:  <?php echo $cart; ?>
            </p>
            
            <p>
                <label>Name:</label><br><input type="text" id="theName" name="theName">
                <?php if(isset ($nameMsg)){
                    echo $nameMsg;
                } ?>
                <br><span id="nameMsg" style="color:red"></span>
            </p>

            <p>
                <label>Comments:</label><br>
                <textarea id="comments" name="comments"></textarea><br>
                <?php if(isset ($commentMsg))
                        {
                            echo $commentMsg;
                        }
                ?>
                <br><span id="commentMsg" style="color:red"></span>
            </p>
            <p>
                <input type="submit" name="Submit_Review" value="Submit">
            </p>
        </form>
        <?php } ?>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
