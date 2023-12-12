<?php

@include 'config.php';
session_start();
if(!isset($_SESSION['name'])){
    header('location:login.php');
}else{
    $name = $_SESSION['name'];

}

if(isset($_POST['available_type'])&& isset($_POST['available_id'])){
    $type = $_POST['available_type']==1? 0 : 1; // 1 or 0
    $id = $_POST['available_id'];
    $query = "UPDATE `item` SET `available` = $type  WHERE `item`.`r_id` = $id";
    mysqli_query($conn, $query);
}
if(isset($_POST['edit'])){
    header('location: upload.php?rid='.$_POST['edit']);
}
if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $query = "DELETE FROM `item` WHERE `item`.`r_id` = $id";
    mysqli_query($conn, $query);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cstyles.css">
    <style>
        .cards{
            width: 100%;
            max-width: 900px;
            margin:  auto;
            /* overflow: hidden; */
        }
        .wide-card{
            margin: 15px 0;
            text-align: left;
            display: grid;
            columns: 1fr 10;
            grid-template-columns: 1fr 8fr 1fr;
            padding: 5px;
            
        }
        .wide-card > img{
            width: 100px;
            height: 100px;
        }
        .wide-card > .desc{
            
            padding: 5px 20px;
           

        }
        .wide-card > .options{
            margin: auto ;
            text-align: center;

            display: grid;
            grid-template-columns: 1fr;
            gap: 15px ;
        
        }
 
        .icon{
            width: 20px;
        }
        .icon:hover,  .available{
            cursor: pointer;
        }
        .options form{
            margin: auto;
        }
 
    </style>
    <title>Owner Dashboard</title>
</head>
<body>
    <header>
        <div class="branding">
            <h1 class="app-name" ><span>N</span>eedy</h1>
        </div>
        <div class="user-info">
            <span class="user-name"><?php if(isset($name)) echo $name ?></span>
            <img class="user-icon" src="asserts/user.png" alt="user Icon"/>
        </div>
    </header>
    <div class="container">
        <div class="cards ">
     
            <?php 
          

                if(isset($_SESSION['mobile'])){
                    $oid =$_SESSION['mobile'];
                    $list_query = "SELECT * FROM `item` WHERE`o_id`= $oid  ORDER BY `r_id` DESC" ;
                    $result = mysqli_query($conn, $list_query);
                    while($row = mysqli_fetch_assoc($result)){

                        ?>

                <div class="wide-card shadow">
                    <img src="<?=$row['image']?>" alt="room img"/>

                    <div class="desc">
                        <div class="name"><?=$row['name']?></div>
                        <div class="description"><?=$row['description']?></div>
                    </div>

                    <div class="options">
                        <form action="" method="post">
                            <input type="checkbox" class=" available" <?=$row['available']==1?  'checked':''?> onchange="submit()"  id="available">
                            <input type="hidden" name="available_type" value=<?=$row['available']?>>
                            <input type="hidden" name="available_id" value=<?=$row['r_id']?>>
                        </form>
                        <!-- <form action="" method="post">
                            <label for="edit">                   
                                <img src="asserts/pencil.png" onclick="submit()" alt="edit" class="edit icon">
                            </label>
                            <input type="hidden" name="edit" id="edit"  value="<?=$row['r_id']?>"/>
                        </form> -->
                        <form action="" method="post">
                            <label for="delete">
                                <img src="asserts/delete.png" alt="delete" onclick="submit()" class="delete icon">
                            </label>
                            <input type="hidden" name="delete" id="delete"  value="<?=$row['r_id']?>"/>
                        </form>
                            
                    </div>
                </div>

            <?php
                    }
                }            
            ?>

        <a href="upload_new.php">
         <div class="nav-btn">+</div>
        </a>
    </div>
   
</body>
</html>