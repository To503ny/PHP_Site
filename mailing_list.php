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
        <h2>The Mailing List</h2>
        <table width="100%" cellpadding="5">
            <tr><th>Name</th><th>Phone</th><th>Email</th><th>Comments</th></tr>
            <?php
                include('includes/dbc.php');
                $query = "SELECT * FROM mailing_list ORDER BY id";
                $result = mysqli_query($con, $query);
                if($result == false){
                    $error_message = mysqli_error();
                    echo "<p>There has been a query error: $error_message</p>";
                }
            if(mysqli_num_rows($result) == 0){
                echo "No members are singed up yet.";
            }
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td>' . $row['name'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['comments'] . '</td></tr>';
            }
            ?>
        </table>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
