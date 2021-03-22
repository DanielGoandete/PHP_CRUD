<?php

session_start();
$mysqli = new mysqli('localhost','root','root','crud') or die(mysqli_error($mysqli)); 
$update = false;
$name = '';
$location = '';
$id = 0;



//save 
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    
    //send messge after save
    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    //return to main page
    header("location: index.php");

    $mysqli ->query ("INSERT INTO data (name, location) VALUES('$name','$location')") or 
        die($mysqli -> error);
}

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];


    $mysqli ->query ("DELETE FROM data WHERE id=$id") or die($mysqli -> error());

     //send messge after delete
    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    //return to main page
    header("location: index.php");
}


//edit
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
   $result =  $mysqli ->query ("SELECT  * FROM data WHERE id=$id") or die($mysqli -> error());
   if(count($result) == 1){
       $row = $result ->fetch_array();
       $name = $row['name'];
       $location = $row['location'];
   }    
}


//update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $mysqli ->query ("UPDATE  data SET name='$name', location='$location' WHERE id=$id") or die($mysqli -> error);

    //send messge after update
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
   
}



?>