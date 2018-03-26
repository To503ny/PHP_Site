<!--Start the session for user-->
<?php
    session_start();
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<!--HTMl tag-->
<html>
<!--Head Tag, houses important information such as the title of the site, and any links to stylesheets and scripts.-->
<head>
<!--Title Tag, shows the name of the site on the browser tab-->
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" /><!--link to CSS stylesheet for the site-->
</head>

<body><!-- the body tag holds all the main content the site will show-->

    <?php include('includes/header.inc'); ?><!--PHP include statement to place the header.inc file in its place.-->
    
    <?php include('includes/nav.inc'); ?><!--PHP include statement to place the nav.inc file in its place.-->
    
<div id="wrapper"><!--div tag with an id of wrapper to help with CSS styling-->


	
    <?php include('includes/aside.inc'); ?><!--PHP include statement to place the aside.inc file in its place.-->

	<section><!--HTML5 tag to indicate this is a related group of information.-->
        <?php
            include('includes/dbc.php');//PHP include statement to connect to the DB
            $query = "SELECT * FROM home_page ORDER BY id DESC";//setting the $query variable to the selection from the DB
            $result = mysqli_query($con, $query); // $con from dbc.php
            if($result == false)//return a error if there was a problem
            {
                $error_message = mysqli_error();
                echo "<p>There has been a query error: $error_message</p>";//displaying the error to the user
            }
            if(mysqli_num_rows($result) == 0)//checking if there is any content to display and letting the user know if not.
            {
                echo "No content is available at this time. Please check back soon.";
            }
            while ($row=mysqli_fetch_assoc($result))
            {
                if(isset($user)){//if an admin is logged in
                    echo '<div style="float:right; padding:10px;">';//setting styles for the page
                    echo '<a href="ajax_edit.php?id='.$row['id'].'&table=home_page">Edit</a>';//Creating a link to edit the page if the user is an admin
                    echo '</div>';//closing the div
                }
                echo '<h2>'.$row['title'].'</h2>';
                echo '<p>'.$row['message'].'</p>';
            }
            mysqli_free_result($result);
            mysqli_close($con);//close the connection
        ?>
	</section>

</div>

<?php include('includes/footer.inc'); ?><!--PHP include statement to place the footer.inc file in its place.-->

</body>
</html>
