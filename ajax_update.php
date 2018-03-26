<?php

if(isset($_POST['id'])){
    include('../includes/dbc_admin.php');
    $table = $_POST['table'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $sql = "UPDATE $table SET title='$title',message='$message' WHERE id=$id";
    $result = mysqli_query($con,$sql);
    if($result){
        echo '<em>Your content successfully updated!</em><br>';        
    }else{
        $error_msg = mysqli_error($con);
        echo '<em>There was an error: $error_msg';
    } // end else
} // end if

?>