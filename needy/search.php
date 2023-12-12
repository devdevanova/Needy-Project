<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cstyles.css">
    <style>

        .filters{
            padding: 10px;
            background-color: antiquewhite;
            margin-bottom: 10px;
        }
        .cards{
           gap: 20px;
           display: grid;
           justify-items: center;
           grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        .card{
            padding: 5px;
            height: 270px;
            width: 200px;
            border-radius: 5px;
            
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card:hover{
            box-shadow: 0px 0px 10px #aaa;
            cursor: pointer;
        }
        .card> img{
            height: 70%;
            width: 100%;
           
        }
        .card > .desc{
            padding: 5px 10px;
        }
        .card >.desc> .cost{
            font-size: 20px;
            font-weight: 700;
            text-align: left;
        }
        .card>.desc > .location{
            text-align: left;
            font-size: 17px;
        }

    </style>
    <title>Search For a Room</title>
</head>
<body>
    <header>
        <div class="branding">
            <h1 class="app-name" ><span>N</span>eedy</h1>
        </div>

    </header>

    <div class="container">
        <!-- <div class="filters">
            <div class="select-location">Select Location</div>
            <div class="select-cost">Select Cost</div>
        </div> -->

        <div class="cards">

            <?php
                @include 'config.php';

                $query = "SELECT * FROM `item`  WHERE `available`= 1   ORDER BY `r_id` ASC";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <a href="roomdetails.php?rid=<?=$row['r_id']?>">
                        <div class="card shadow">
                            <img src="<?=$row['image']?>" alt="img" srcset="">
                            <div class="desc">
                                <div class="cost">₹ <span class="amount"><?=$row['cost']?></span></div>
                                <div class="location"><?=$row['location']?></div>
                            </div>
                        </div>
                    </a>
                <?php
                }
            ?>

        </div>
    </div>
</body>
</html>