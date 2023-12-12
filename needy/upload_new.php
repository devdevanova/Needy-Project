<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['name'])){
    header('location:login.php');
}else{
    $name = $_SESSION['name'];

}

if(isset($_POST['submit'])){

    
    // path of images
    // $target = "uploads/".basename($_FILES["image"]["name"]);
    // $target = "uploads";

    // if(move_uploaded_file($_FILES["image"]["tmp_name"],$target)){
    //  echo "upload succss";   
    // }else{
    //     echo "uplaod failed";
    // }

    $oid = $_SESSION['mobile'];

    
    $cost = $_POST['Item-cost'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['mobile'];
    $desc = $_POST['description'];
    $time = time();

    // uniqid("Img-",true)
    if(isset($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $image_name = 'IMG-'.$time.'.' .strtolower(pathinfo($image,PATHINFO_EXTENSION));
        $path = "uploads/". $image_name;
    }
    
        if(isset($_GET['rid'])){
            $rid = $_GET['rid'];
            if(isset($path)){
               
                $query = "UPDATE `item` SET  `cost` = $cost, `location` = $location, `contact` = $contact, `name` = $name `description` =$desc
                WHERE `item`.`r_id` = $rid";
                mysqli_query($conn,$query);
            }else{
                $query = "UPDATE `item` SET `image`=$path `cost` = $cost, `location` = $location, `contact` = $contact, `name` = $name `description` =$desc
                WHERE `item`.`r_id` = $rid";
                mysqli_query($conn,$query);
                if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
                    $suc_msg = "Image Upload Success";
                    
                }else{
                    $err_msg = "There was an error while uploading image.";
                }
            }
        }else{
            if(isset($path)){
                $query = "INSERT INTO `item` ( `r_id`,`o_id`, `image`,  `cost`, `location`, `description`, `contact`,`name`) 
            VALUES ( $time ,'$oid', '$path',  '$cost', '$location', '$desc', '$contact','$name')";
            mysqli_query($conn,$query);
            if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
                $suc_msg = "Image Upload Success";
                
            }else{
                $err_msg = "There was an error while uploading image.";
            }
            }else{
                $query = "INSERT INTO `item` ( `r_id`,`o_id`,   `cost`, `location`, `description`, `contact`,`name`) 
                VALUES ( $time ,'$oid',   '$cost', '$location', '$desc', '$contact','$name')";
                mysqli_query($conn,$query);
            }
        }

    
 

    
    
    
    
    // mysqli_query($conn,$query);

    // if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
    //     $suc_msg = "Image Upload Success";
        
    // }else{
    //     $err_msg = "There was an error while uploading image.";
    // }
   
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
       
        .image-input{
            margin: auto;
            cursor: pointer;   
            display: block;
            height: 100%;
            /* max-height: 200px; */
            overflow: hidden;
                        
        }
        .image-input > input{
            display: none;
            
        }
        .image-input > img{
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 100%;

        }
       
    </style>
    <script>

        function image_input(){
            var selectedFile = document.getElementById('image');
            var lable = document.getElementById('image-lable');
            const files = selectedFile.files[0];
            if(files){
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function(){
                    lable.innerHTML = '<img src ="'+ this.result + '"/>';
                });
            }
        }
    </script>
    <title>Upload item to item Finder</title>
</head>
<body>
    <header>
        <div class="branding">
            <h1 class="app-name" ><span>N</span>eedy</h1>
        </div>
        <div class="user-info">
            <span class="user-name"><?php echo $_SESSION['name'] ?></span>
            <img class="user-icon" src="asserts/user.png" alt="user Icon"/>
        </div>
    </header>
    <div class="outer">
           
        <form action="" method="post" enctype="multipart/form-data" class="shadow login-form">
            <div class="form-banner">Upload a item</div>

            <?php
                if(isset($suc_msg)){
                    echo '<span class="success text-box">'.$suc_msg.'</span>';
                    header('refresh:1.5; url=dashboard.php');
                }elseif(isset($err_msg)){
                    echo '<span class="error text-box">'.$err_msg.'</span>';
                }
            ?>
          
            <label for="image" id="image-lable" class="text-box image-input">+ Image</label><br/>
            <input type="file" class="hide" oninput="image_input()" accept="image/png, image/jpg, image/jpeg, image/webp" name="image" id="image" placeholder="image"/>

            <input type="number" class="text-box" required name="rent-cost" id="rent-cost" placeholder="Rent Cost"/><br/>
            <input type="text" class="text-box" required name="name" id="name" placeholder="Name"><br>
            <input type="text" class="text-box" required name="location" id="location" placeholder="Location"><br/>
            <input type="tel" class="text-box" pattern="[0-9]{10}" required name="mobile" id="mobile" placeholder="Contact Number"><br>
            <textarea name="description" class="text-box" id="description" cols="30" rows="5" placeholder="Description (Facilities)" ></textarea>
            
            <input name="submit" type="submit" value="Submit" class="form-btn"><br>
            
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_GET['rid'])){
        $rid = $_GET['rid'];
        $query = "SELECT * FROM `item` WHERE `r_id` = $rid";
        $rows = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($rows);
        if( mysqli_num_rows($rows)>0){
            $path = $row['image'];

        ?>
            <script>
             
                document.getElementById('image-lable').innerHTML = '<img src ="<?=$row['image']?>"/>';
                document.getElementById('rent-cost').value = '<?php echo $row['cost']?>';
                document.getElementById('name').value = '<?php echo $row['name']?>';
                document.getElementById('location').value = '<?php echo $row['location']?>';
                document.getElementById('mobile').value = '<?php echo $row['contact']?>';

                document.getElementById('description').value = '<?=str_replace("\r\n", "\\n", $row['description'])?>';
            </script>

        <?php
                }
            }
        ?>

                
        

             

      