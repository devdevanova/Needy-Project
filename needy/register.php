<?php

@include 'config.php';

if(isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['password'])){
    
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['password'];
    $address = $_POST['address'];

    $query = "SELECT * FROM owner WHERE id = '$mobile' && password='$pass'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)>0){
       
        $msg = 'You already Have an account.';
    }else{
        
        $insert = "INSERT INTO `owner` (`id`, `name`, `password`, `address`) VALUES ('$mobile', '$name', '$pass', '$address')";
        mysqli_query($conn,$insert);
        // starting session
        $_SESSION['name'] = $row['name'];
        $_SESSION['mobile'] = $row['mobile'];
        header('location:dashboard.php');   
    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cstyles.css">
    <title>Register to Room Finder</title>
  
</head>
<body>
    <div class="outer">
        <h1 class="app-name" style="margin-top: 30px;"><span>N</span>eedy</h1>
        <div class="tag-line">We for You</div>
        
        <form action="" method="post" class="shadow login-form">
            <div class="form-banner">Register to Needy</div>
            <?php
            
                if(isset($msg) && $msg!=null){
                    echo '<span class="error text-box">'.$msg.'</span>';
                }

            ?>            
            <input type="text" class="text-box" name="name" required id="name" placeholder="Name"/>
            <input type="tel" class="text-box" pattern="[0-9]{10}" required name="mobile" id="mobile" placeholder="Mobile Number"/><br>
            <input type="password" class="text-box" required name="password" id="password" placeholder="Password"/><br/>
            <textarea name="address" id="address" cols="30" rows="5" placeholder="Address" class="text-box address"></textarea>
            
            <input type="submit" value="Register" name="submit" class="form-btn"><br>
            <div class="form-links">
                <span><a href="login.php">Already have an account? Login</a></span>
            </div>
        </form>
    </div>
</body>
</html>