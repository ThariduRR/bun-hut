<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="editOrder.css">

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

    <h1 class="heading"> Order Dashboard </h1>
    <div class="line2"></div>



    <div class="foodDetails">

        <div class="foodDetailsOverlay">
            <h1>Order Details</h1><br>
            <form class="cdetailForm" action="updateOrderStatus.php" method="post" enctype="multipart/form-data">

                <?php
                include('Connection.php');
                session_start();
                $name = $_GET['name'];
                $_SESSION['orderID'] = $_GET['name'];


                if ($name == '') {
                    echo "<script>alert('Couldn't fetch data for the provided order id'); window.location='viewOrders.php'</script>";
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
                $sql3 = 'SELECT * FROM orders where Order_Id = "' . $name . '"';
                $result3 = mysqli_query($conn, $sql3);
                while ($row = mysqli_fetch_array($result3)) {
                    $status = $row['Order_Status'];
                    $reason = $row['Canceled_Reason'];
                }

                ?>

                <p style="font-family: 'Raleway';  color:white; font-size:20px; margin-left: 20px; text-align: left;"> Order Status: <select name="orderStatus" id="orderStatus" style="width:200px; float:none !important; margin-left:20px;">
                        <option value=""> <?php echo $status ?> </option>
                        <option value="Preparing">Pending</option>
                        <option value="Preparing">Preparing</option>
                        <option value="Delivering">Delivering</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                </p>
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 20px; text-align: left; font-weight:1000;"> Cancel Reason: <input type="text" name="" style="width:300px;" value=" <?php echo $reason ?>" readonly></p>
                <input type="submit" name="submit" value="Update order Status">
                <input type="submit" name="delete" value="Delete order"><br>
            </form>
        </div>
    </div>
    </div>

    <div class="content">



    </div>






</body>

</html>