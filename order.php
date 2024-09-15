<?php
session_start();

include 'Connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="order.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="order_script.js"></script>
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

    <div class="content">

        <div class="Search">

            <div class="searchCategory">
                <form class="" action="insertFood.php" method="post" enctype="multipart/form-data">
                    <br>
                    <select name="category" id="category" onchange="searchCategory()">
                        <option value="All">All</option>

                        <?php

                        include('Connection.php');

                        $result = mysqli_query($conn, "SELECT * FROM categories");

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['Category_Name'] . "'> " . $row['Category_Name'] . '</option>';
                        }

                        ?>

                    </select>

                </form>
            </div>

        </div>


        <button type="button" name="button" onclick="openCart()">
            <i class="fa-solid fa-cart-shopping fa-2xl"></i>
        </button>

        <div class="navcart" id="cart">
            <h2 id="header2">Your Cart</h2>
            <button type="button" name="button" onclick="closeCart()">
                <i class="fa-solid fa-xmark fa-2xl"></i>
            </button>
            <br><br><br>

            <nav>
                <div id="cartNav" class="cartFood"></div>
            </nav>

            <div class="line"></div>
            <p class="total">Your total</p>
            <div class="totalPrice">
                <p style="float:right;">.00/=</p>
                <p style="float:right;" id="total">0</p>
                <p style="float:right;"> Rs.</p>
            </div>
            <button type="button" name="button" class="checkOut" onclick="displayArr()">Check out</button>


        </div>

    </div>

    <div class="foods">
        <div class="foodoverlay" id="foodoverlay">


            <?php
            $name = $_SESSION["username"];




            $sql = "SELECT * FROM foods";
            $result = mysqli_query($conn, $sql);

            ?>



            <?php
            $counter = 1;

            while ($row = mysqli_fetch_array($result)) {
                $imgId = "img$counter";
                $dishId = "food$counter";
            ?>



                <div class="dish1" id="<?php echo $dishId ?>">
                    <img id="<?php echo $imgId ?>" src="img/<?php echo $row['Food_Image']; ?>" alt="<?php echo $row['Food_Name']; ?>">
                    <h2><?php echo $row['Food_Name']; ?></h2>
                    <h3>Category</h3>
                    <p><?php echo $row['Food_Category']; ?></p>
                    <h3>Ingredients</h3>
                    <p><?php echo $row['Food_Ingredients']; ?></p>
                    <h2>Rs <?php echo $row['Food_Price']; ?>.00</h2>
                    <button type="button" name="button" onclick="addToCart(<?php echo $dishId ?>)"> Add to cart </button>
                </div>

            <?php

                $counter++;
            }


            ?>

        </div>
    </div>

    <div class="tempdiv" id="tempdiv">
        <form class="" id="tempfrom" action="insertOrder.php" method="post">


            <input type="submit" name="submit" id="tsubmit" value="checkout">

        </form>

    </div>


    <script src="order_script.js"></script>

    <script type="text/javascript">
        function addToDataBase() {

            var currentdate = new Date();
            var datetime = "Last Sync: " + currentdate.getDate() + "/" +
                (currentdate.getMonth() + 1) + "/" +
                currentdate.getFullYear() + " @ " +
                currentdate.getHours() + ":" +
                currentdate.getMinutes();

            var pdiv = document.getElementById('cartNav');
            var children = pdiv.children;
            var childDivs = document.getElementById('cartNav').querySelectorAll('div').length;

            window.alert(childDivs);

            for (var i = 0; i < childDivs; i++) {
                var child = children[i];
                var tmpstrPrice = child.children[4].innerText;
                window.alert(tmpstrPrice);

            }
        }

        function displayArr() {

            var childDivs = document.getElementById('cartNav').querySelectorAll('div').length;
            var pdiv = document.getElementById('cartNav');
            var children = pdiv.children;

            for (var i = 0; i < childDivs; i++) {

                var currentdate = new Date();
                var datetime = currentdate.getDate() + "/" +
                    (currentdate.getMonth() + 1) + "/" +
                    currentdate.getFullYear() + " @ " +
                    currentdate.getHours() + ":" +
                    currentdate.getMinutes();

                var child = children[i];

                cartArr.push(child.children[3].innerText);
                cartArr.push(child.children[4].innerText);
                cartArr.push(child.children[2].value);
                cartArr.push(child.children[0].currentSrc);
                cartArr.push(datetime);

            }

            var arrCount = 0;
            for (var x = 0; x < childDivs; x++) {
                var selectedItem = document.getElementById('tempfrom');

                var tcount = document.createElement("input");
                tcount.classList.add('tcount');
                tcount.setAttribute('id', 'tcount');
                tcount.setAttribute('name', 'tcount');
                tcount.setAttribute('type', 'tcount');
                tcount.setAttribute('value', childDivs);

                var tname = document.createElement("input");
                tname.classList.add('tnameClass');
                tname.setAttribute('id', 'tname');
                tname.setAttribute('name', 'tname' + x);
                tname.setAttribute('type', 'text');
                tname.setAttribute('value', cartArr[arrCount]);

                var stPrice = cartArr[arrCount + 1];
                var cleanPrice = parseInt(stPrice.replace(/[^\d\.]+/, ''));

                var tprice = document.createElement("input");
                tprice.classList.add('tpriceClass');
                tprice.setAttribute('id', 'tprice');
                tprice.setAttribute('name', 'tprice' + x);
                tprice.setAttribute('type', 'text');
                tprice.setAttribute('value', cleanPrice);

                var tqty = document.createElement("input");
                tqty.classList.add('tqtyClass');
                tqty.setAttribute('id', 'tqty');
                tqty.setAttribute('name', 'tqty' + x);
                tqty.setAttribute('type', 'text');
                tqty.setAttribute('value', cartArr[arrCount + 2]);

                var timg = document.createElement("input");
                timg.classList.add('timgClass');
                timg.setAttribute('id', 'timg');
                timg.setAttribute('name', 'timg' + x);
                timg.setAttribute('type', 'text');
                timg.setAttribute('value', cartArr[arrCount + 3]);

                var tdate = document.createElement("input");
                tdate.classList.add('tdateClass');
                tdate.setAttribute('id', 'tdate');
                tdate.setAttribute('name', 'tdate' + x);
                tdate.setAttribute('type', 'text');
                tdate.setAttribute('value', cartArr[+4]);

                selectedItem.append(tcount);
                selectedItem.append(tname);
                selectedItem.append(tprice);
                selectedItem.append(tqty);
                selectedItem.append(timg);
                selectedItem.append(tdate);

                arrCount = arrCount + 5;
                var submit = document.getElementById("tsubmit");
                submit.click();
            }


        }


        function searchCategory() {
            var dropdown = document.getElementById("category");
            var selected = dropdown.options[dropdown.selectedIndex].value;
            var divCount = document.getElementById('foodoverlay').querySelectorAll('div').length;

            var fooddiv = document.getElementById('foodoverlay');
            var children = fooddiv.children;


            for (var i = 0; i < divCount; i++) {
                var idcount = i + 1;
                var divID = "food" + idcount;

                var div = document.getElementById(divID);
                var child = children[i];
                var cate = child.children[3];

            }

            window.alert(cate.innerText);



        }
    </script>
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

</body>

</html>