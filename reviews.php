<?php
session_start();
$cart = $_COOKIE['MyProductReviews'];
if (isset($_POST['clear'])){
    $expire = time() - 60*60*24*7*365;
    setcookie("MyProductReviews", $cart, $expire);
    header("Location:reviews.php");
}//end if
if($cart && $_GET['id']) {
    $cart = $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyProductReviews", $cart, $expire);
    header("Location:reviews.php");
}//end if
if(!$cart && $_GET['id']) {
    $cart .= $_GET['id'];
    $expire = time() +60*60*24*7*365;
    setcookie("MyProductReviews", $cart, $expire);
    header("Location:reviews.php");
}//end if
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
	<h2>Reviews for Product <?php echo $cart?></h2>
	   <table width = "100%">
           <tr>
                <th>Name</th>
                <th>Comment</th>
                <th>Review Date</th>
           </tr>
           <?php
                    $cart = $_COOKIE['MyProductReviews'];
                    if($cart){
                        $i = 1;
                        include('includes/dbc.php');
                        $items = explode(" ", $cart);
                        foreach($items AS $item){
                            $sql = "SELECT * FROM reviews WHERE product_id = '$cart'";
                            $result = mysqli_query($con, $sql);
                            if($result == false){
                                $mysql_error = mysqli_error($con);
                                echo "There was a query error: $mysql_error";
                            }
                            else if (mysqli_num_rows($result) == 0){
                                echo '<tr><td colspan="3">There are currently not any reviews for this product! You are welcome to be the first!</td>';
                                echo '<td><a href="add_review.php?id=' . $cart . '">Add Review</a></td</tr>';
                            }else{
                                while($row=mysqli_fetch_assoc($result)) {
                                    echo '<tr><td align="center">' . $row['name'] . '</td>';
                                    echo '<td align="center">' . $row['comment'] . '</td>';
                                    echo '<td align="center">' . $row['review_date'] . '</td></tr>';
                                }//end while
                                $i++;
                            }//end else
                        }//end foreach
                    }//end if
           ?>
        </table><br />
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
