<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="viewOrders.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="nav">

        <nav>
            <ul>
                <li>
                    <a href="adminProfile.php" class="logo">
                        <img src="images/BunHutLogo.png" alt="">
                        <span class="nav-item">Admin Menu</span>
                    </a>
                </li>

                <li><a href="adminProfile.php">
                        <i class="fas fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a></li>

                <li><a href="manageManagers.php">
                        <i class="fas fa-solid fa-user-gear"></i>
                        <span>Managers</span>
                    </a></li>

                <li><a href="viewCustomer.php">
                        <i class="fas fa-solid fa-users-line"></i>
                        <span>Customer</span>
                    </a></li>

                <li><a href="viewOrders.php">
                        <i class="fas fa-solid fa-cart-shopping"></i>
                        <span>Orders</span>
                    </a></li>


                <li><a href="foodItems.php">
                        <i class="fas fa-solid fa-burger"></i>
                        <span>Food items</span>
                    </a></li>

                <li><a href="logoutAdmin.php" class="logout">
                        <i class="fas fa-solid fa-right-from-bracket"></i>
                        <span>Log out</span>
                    </a></li>
            </ul>


        </nav>
    </div>

    <h1 class="heading"> Available Orders </h1>
    <div class="line2"></div>


    <div class="section3">

        <?php
        include 'Connection.php';
        $sql = "SELECT * FROM items";
        $result = mysqli_query($conn, $sql);

        $rowcount = mysqli_num_rows($result);



        $sql2  = 'SELECT * FROM items';

        $result2 = mysqli_query($conn, $sql2);
        ?>



        <?php
        while ($row = mysqli_fetch_array($result2)) {
        ?>

            <div class="dish1" onclick="window.location.href = 'editOrder.php?name=<?php echo $row['Order_Id']; ?>'">
                <h2>Order Number:# <?php echo $row['Order_Id']; ?></h2>
                <p>Food: <?php echo $row['Item_Name']; ?></p>
                <p>Price: <?php echo $row['Item_Price']; ?></p>
                <p>Quantity: <?php echo $row['Item_Qty']; ?></p>
                <p>Order Date & Time: <?php echo $row['Item_Date']; ?></p>
                <p>Customer Name: <?php echo $row['Customer'] ?></p>
            </div>

        <?php
        }

        mysqli_close($conn);
        ?>

    </div>

    <div class="content">





    </div>
    <script type="text/javascript">
        function removeDivs() {
            const divs = document.querySelector('div');

            divs.forEach(div => {
                if (divs.innerHTML === '') {
                    div.remove();
                }
            });
        }
    </script>


</body>

</html>