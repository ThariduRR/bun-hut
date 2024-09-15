<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="invoice.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

</head>

<body>


    <div class="navbar" id="navbar">
        <a href="index.html"><img class="logo" alt="logo.png" src="src/logo-2.png" width="195px" height="55px" /></a>
        <div class="navbar-profile">
            <a href="customerLoginCheck.php"><img alt="profile icon.png" src="src/profile_icon.png" /></a>
        </div>
        <div class="navbar-menu" id="navbar-menu">
            <ul>
                <li><a href="index.html"> Home</a></li>
                <li><a href="customerOrderLoginCheck.php"> Order</a></li>
                <li><a href="about.html"> About</a></li>
                <li><a href="contact.html"> Contact</a></li>
            </ul>
        </div>

    </div>

    <div class="managerTable">
        <h1>Order Status</h1>
        <div class="line"></div>



        <?php
        include('Connection.php');
        session_start();




        if (isset($_SESSION['lastId'])) {
            if ($_SESSION['lastId'] == '') {
                echo "<script>alert('Couldn't fetch data for the provided username'); window.location='customerLogin.html'</script>";
            } else {
                $lastId = $_SESSION['lastId'];
                $sql = 'SELECT Item_Name, Item_Price, Item_Qty FROM items where Order_Id = "' . $lastId . '"';
                $result = mysqli_query($conn, $sql);

                echo "<table border = 1 id='tbId'>";
                echo "<tr>";
                echo "<th> Item Name </th>";
                echo "<th> Item Quantity </th>";
                echo "<th> Item Price </th>";
                echo "</tr>";
                $sum = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $sum = $row['Item_Price'] + $sum;
                    echo "<tr>";
                    echo "<td>" . $row['Item_Name'] . "</td>";
                    echo "<td>" . $row['Item_Qty'] . "</td>";
                    echo "<td>Rs " . $row['Item_Price'] . ".00</td>";
                    echo "</tr>";
                }

                echo "<tr>";
                echo "<td>Total</td>";
                echo "<td></td>";
                echo "<td>Rs " . $sum . ".00</td>";
                echo "</tr>";

                echo "</table>";

                mysqli_close($conn);
            }
        } else {
            echo "<script>alert('Login required to view the profile'); window.location='customerLogin.html'</script>";
        }



        ?>
    </div>

    <div class="content">

        <div class="payForm">
            <form class="" action="payWall.php" method="post">
                <p>Select Payment Option</p>
                <input type="radio" id="payment" name="payment" value="online">
                <label for="html">Online</label>
                <input type="radio" id="payment" name="payment" value="cash" checked>
                <label for="css">Cash on Delivery</label>

                <input type="submit" name="" value="Continue">
            </form>

        </div>

    </div>


    <!-- social Section Starts Here -->
    <section class="social">
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
    </section>
    <!-- social Section Ends Here -->


    <script src="order_script.js"></script>




</body>

</html>