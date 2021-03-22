<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
  

<body>
    <?php require_once 'process.php'; ?>
    <?php 
        if(isset($_SESSION['message'])):?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>  
  
  <div class="container-md">
    
     <?php $mysqli = new mysqli('localhost','root','root','crud') or die(mysqli_error($mysqli));
           $result =$mysqli -> query("SELECT * FROM data") or die(mysqli_error($mysqli));
           // pre_r($result);
        //    pre_r( $result -> fetch_assoc());
     ?>
    <div class="row justify-content-center"> 
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result -> fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id'];?>"
                                    class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id'];?>"
                                    class="btn btn-danger">Delete</a>    
                            
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </table>
    
    </div>


    <?php
         

           function pre_r($array){
                echo '<pre>';
                print_r($array);
                echo '</pre>';
           }
     
     ?>
     <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <div  style="width: 30%;height: 30%;position: relative;margin-left: auto;margin-right: auto;">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" maxlength="48"  name="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter your Name">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location"  maxlength="48" class="form-control" value="<?php echo $location;?>" placeholder="Enter your Location">
                </div>
                <div class="form-group">    
                <?php 
                        if($update == true): ?>
                        <button type="submit"  class="btn btn-info" name="update">Update</button>
                        <?php else: ?>
                            <button type="submit"  class="btn btn-primary" name="save">Save</button>
                        <?php endif; ?>    
                </div>
            </div>
        </form>
      </div>
       
   </div> 
    <!-- <script src="script.js"></script> -->
</body>
</html>
