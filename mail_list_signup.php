<?php
if(isset($_POST['Submit_Mail_List'])) {
    $name = $_POST['theName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];
    if($name=="") {
        $nameMsg = "<br><span style='color:red;'>Your name cannot be blank.</span>";
    }
    if($phone=="") {
        $phoneMsg = "<br><span style='color:red;'>Your phone number cannot be blank.</span>";
    }
    if($email=="") {
        $emailMsg = "<br><span style='color:red;'>Your email cannot be blank.</span>";
    }else {
        include('includes/dbc_admin.php');
        $query = "INSERT INTO mailing_list (name,phone,email,comments) VALUES ('$name','$phone','$email','$comments')";
        $success = mysqli_query($con, $query);
        if($success) {
            $inserted = "<h2>Thanks!</h2><h3>Your gonna see some emails</h3>";
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
        var phone = document.form1.phone.value;
        var email = document.form1.email.value;
        console.log("theName= " + theName + " " + "phone = " + phone + " " + "email = " + email);
        var nameMsg = document.getElementById('nameMsg');
        var phoneMsg = document.getElementById('phoneMsg');
        var emailMsg = document.getElementById('emailMsg');
        if(theName == "") {nameMsg.innerHTML = "Your name cannot be blank."; return false;}
        if(phone == "") {phoneMsg.innerHTML = "Your phone number cannot be blank."; return false;}
        if(email == "") {emailMsg.innerHTML = "Your email cannot be blank."; return false;}
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
        <h2>Mailing List Sign-Up</h2>
        <?php if(isset($inserted)) {echo $inserted; } else { ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="form1" onSubmit="return validateForm()">
            <p>
                <label>Name:</label><br><input type="text" id="theName" name="theName">
                <?php if(isset ($nameMsg)){
                    echo $nameMsg;
                } ?>
                <br><span id="nameMsg" style="color:red"></span>
            </p>
            <p>
                <label>Phone:</label><br><input type="text" id="phone" name="phone">
                <?php if(isset ($phoneMsg)){
                    echo $phoneMsg;
                } ?>
                <br><span id="phoneMsg" style="color:red"></span>
            </p>
            <p>
                <label>Email:</label><br><input type="text" id="email" name="email">
                <?php if(isset ($emailMsg)){
                    echo $emailMsg;
                } ?>
                <br><span id="emailMsg" style="color:red"></span>
            </p>
            <p>
                <label>Comments:</label><br>
                <textarea id="comments" name="comments">
                </textarea><br>
            </p>
            <p>
                <input type="submit" name="Submit_Mail_List" value="Submit">
            </p>
        </form>
        <?php } ?>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
