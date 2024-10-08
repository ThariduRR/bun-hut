<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="viewOrderDetails.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>

<body>


    <!-- Navbar Section Starts Here -->
    <section class="navbar" id="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.html" title="Logo">
                    <img src="images/BunHutLogo.png" alt="Restaurant Logo" class="img-responsive1">
                </a>
            </div>

            <div class="navbar-profile">
                <a href="customerLoginCheck.php"><img alt="profile icon.png" src="src/profile_icon.png" /></a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="customerOrderLoginCheck.php">Orders</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


    <?php
    include('Connection.php');
    session_start();


    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == '') {
            echo "<script>alert('Couldn't fetch data for the provided username'); window.location='customerLogin.html'</script>";
        } else {
            $name = $_SESSION['username'];
            $sql = 'SELECT * FROM customers where Username = "' . $name . '"';

            $result = mysqli_query($conn, $sql) or
                die("Couldn't execute query." . mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
            }
        }
    } else {
        echo "<script>alert('Login required to view the profile'); window.location='customerLogin.html'</script>";
    }



    ?>

    <div class="content">
        <div class="header">
            <h1>Order Dashboard</h1>
            <div class="line"></div>
        </div>

        <div class="foodDetails">

            <div class="foodDetailsOverlay">
                <h1>Order Details</h1><br>
                <form class="cdetailForm" action="cancelOrder.php" method="post" enctype="multipart/form-data">

                    <?php
                    include('Connection.php');
                    $name = $_GET['name'];
                    $_SESSION['orderID'] = $_GET['name'];


                    if ($name == '') {
                        echo "<script>alert('Couldn't fetch data for the provided order id'); window.location='viewOrderDetails.php'</script>";
                    } else {

                        include 'Connection.php';
                        $sql = 'SELECT * FROM items where Order_Id = "' . $name . '"';
                        $result = mysqli_query($conn, $sql);


                        while ($row = mysqli_fetch_array($result)) {
                    ?>

                            <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 20px; text-align: left; font-weight:1000;"> Food Name: <input type="text" name="" style="width:300px;" value=" <?php echo $row['Item_Name'] ?>" readonly> Food Price: <input type="text" style="width:70px;" name="" value="<?php echo $row['Item_Price'] ?>" readonly> Food Quantity: <input type="text" style="width:50px; text-align: center;" name="" value="<?php echo $row['Item_Qty'] ?>" readonly> </p>


                    <?php

                        }

                        mysqli_close($conn);
                    }

                    ?>
                    <br><br>
                    <?php
                    include 'Connection.php';
                    $sql3 = 'SELECT Order_Status FROM orders where Order_Id = "' . $name . '"';
                    $result3 = mysqli_query($conn, $sql3);
                    while ($row = mysqli_fetch_array($result3)) {
                        $status = $row['Order_Status'];
                    }

                    ?>

                    <p style="font-family: 'Raleway';  color:white; font-size:20px; margin-left: 20px; text-align: left;"> Order Status: <input type="text" name="" style="width:300px;" value=" <?php echo $status ?>" readonly></p><br><br><br>
                    <p style="font-family: 'Raleway';  color:white; font-size:20px; margin-left: 20px; text-align: left;"> Cancel the Order: <input type="text" name="cancel" id="cancel" placeholder="Reason for cancellation" style="width:750px;" value="" required></p>

                    <input type="submit" name="submit" value="Cancel the Order"><br>
                </form>
            </div>
        </div>

    </div>


    <div class="footer">

        <div class="footer1">
            <h2>Follow us</h2>
            <div class="line2"></div>
            <a href="https://www.facebook.com/"><img src="src/facebook.png" alt="Facebook"></a>
            <a href="https://twitter.com/i/flow/login?redirect_after_login=%2F%3Flang%3Den"><img src="src/twitter.png" alt="Twitter"></a>
            <a href="https://www.instagram.com/"><img src="src/instagram.png" alt="Instagram"></a>
            <p>Follow us on our Social medias to get exiting news and updates as quickly as possible.</p>
        </div>

        <div class="footer2">
            <h2>Visit us</h2>
            <div class="line2"></div>
            <div class="footerMap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0852880755856!2d79.85390697473439!3d6.880385618913761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25b5cf5b2e5bf%3A0x94c6a489a3343ef9!2sBurger%20Hut%20(Marine%20Drive)!5e0!3m2!1sen!2slk!4v1689839148010!5m2!1sen!2slk" width="100%" height="225px" style="border:0; text-align:center;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <p>No. 32 Kinross Avenue, Marine Dr, 00400</p>
        </div>

        <div class="footer3">
            <h2>Contact us</h2>
            <div class="line2"></div>
            <p>Mobile numbers: +94 760 150783, +94 112 350896</p>
            <p>Email: <a href="gmail.com">bunhut@gmail.com</a></p>
            <p>Email: <a href="gmail.com">bunhutlk@yahoo.com</a></p>
            <p>Please make sure to contact our restaurant with in the working ours for a better service. Thank you!</p>


        </div>


    </div>


    <script src="order_script.js"></script>


</body>

</html>