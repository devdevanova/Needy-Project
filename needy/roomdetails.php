<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cstyles.css">
    <style>
        .room-img {
            width: auto;
            max-width: 100%;
            margin: auto;
            display: block;
            height: 400px;
            /* max-height: 400px; */
        }

        .preview {
            text-align: left;
            padding: 15px;
            width: fit-content;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cost {
            font-size: 25px;
            /* margin: 5px 0; */
            font-weight: 700;
        }

        .icon {
            width: 20px;
            margin: 5px auto 0;
        }
        .details{
            display: grid;
            grid-template-columns: 20px 2fr;
            gap: 15px 30px;

        }
    </style>
    <title>Item Details</title>
</head>

<body>
    <header>
        <div class="branding">
            <h1 class="app-name"><span>N</span>eedy<Span></h1>
        </div>
        <!-- <div class="user-info">
            <span class="user-name">John Smith</span>
            <img class="user-icon" src="asserts/user.png" alt="user Icon" />
        </div> -->
    </header>

    <div class="container preview shadow">
        <?php
            @include 'config.php';

            $rid = $_GET['rid'];

            $query = "SELECT * FROM `item`  WHERE `r_id`= $rid";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($result)){


                ?>
          
        <img src="<?=$row['image']?>" alt="room img" class="room-img">
        <ul class="details">
            <li>
                <div class=" cost">₹</div>
            </li>
            <li><span class="amount cost"><?=$row['cost']?></span></li>
            <li><img src="asserts/user.png" alt="owner" class="icon"></li>
            <li><?=$row['name']?></li>
            <li><img src="asserts/location.png" class="icon" alt="location"></li>
            <li>
                <div class="location"><?=$row['location']?>
                </div>
            </li>
            <li><img src="asserts/facilities.png" alt="facilities" class="icon"></li>
            <li>
                <div class="desc">
                <?=str_replace("\r\n", "<br>", $row['description'])?>
                </div>
            </li>

            <li><img src="asserts/phone.png" alt="phone" class="icon"></li>
            <li>
                <div class="contact">
                    +91 <span class="mobile"><?=$row['contact']?></span>
                </div>
            </li>
        </ul>
    </div>
    <?php
            }
        
        ?>
</body>

</html>