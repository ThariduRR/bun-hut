<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Burger Hub</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="managerProfile.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=REM:wght@600&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


    <div class="nav">

        <nav>
            <ul>
                <li>
                    <a href="managerProfile.php" class="logo">
                        <img src="src/logo-3.png" alt="">
                        <span class="nav-item">Manager Menu</span>
                    </a>
                </li>

                <li><a href="managerProfile.php">
                        <i class="fas fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a></li>

                <li><a href="viewCustomersmng.php">
                        <i class="fas fa-solid fa-users-line"></i>
                        <span>Customer</span>
                    </a></li>

                <li><a href="viewOrdersmng.php">
                        <i class="fas fa-solid fa-cart-shopping"></i>
                        <span>Orders</span>
                    </a></li>


                <li><a href="foodItemsmng.php">
                        <i class="fas fa-solid fa-burger"></i>
                        <span>Food items</span>
                    </a></li>

                <li><a href="logoutManager.php" class="logout">
                        <i class="fas fa-solid fa-right-from-bracket"></i>
                        <span>Log out</span>
                    </a></li>
            </ul>


        </nav>
    </div>




    <?php
    include('Connection.php');
    session_start();

    if (isset($_SESSION['managerUsername'])) {
        if ($_SESSION['managerUsername'] == '') {
            echo "<script>alert('Couldn't fetch data for the provided username'); window.location='managerLogin.html'</script>";
        } else {
            $name = $_SESSION['managerUsername'];
            $sql = 'SELECT * FROM managers where Username = "' . $name . '"';

            $result = mysqli_query($conn, $sql) or
                die("Couldn't execute query." . mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
            }
        }
    } else {
        echo "<script>alert('Login required to view the profile'); window.location='managerLogin.html'</script>";
    }


    ?>

    <div class="content">

        <h1 class="heading"> Manager Dashboard </h1>
        <div class="line2"></div>

        <div class="bar">

            <div class="element1">

                <?php
                include 'Connection.php';

                $today = date("Y-m-d");

                $sql = 'SELECT * FROM orders where Date = "' . $today . '"';
                $result = mysqli_query($conn, $sql);

                $ordercount = mysqli_num_rows($result);


                ?>



                <p style="margin-right: 80px; margin-top: 20px;">Order Amount</p>
                <img src="src/graph.svg" alt="">
                <h2># <?php echo $ordercount ?> </h2>

            </div>


            <div class="element2">

                <?php
                include 'Connection.php';

                $today = date("Y-m-d");

                $sql = 'SELECT * FROM customers';
                $result = mysqli_query($conn, $sql);

                $customercount = mysqli_num_rows($result);


                ?>

                <p style="margin-right: 40px; margin-top: 20px;">Number of Customers</p>
                <img src="src/person.svg" alt="">
                <h2>#<?php echo $customercount ?></h2>

            </div>

            <div class="element3">

                <?php
                include 'Connection.php';

                $today = date("Y-m-d");

                $sql = 'SELECT * FROM inquiries';
                $result = mysqli_query($conn, $sql);

                $inquirycount = mysqli_num_rows($result);


                ?>

                <p style="margin-right: 80px; margin-top: 20px;">Inquiry amount</p>
                <img src="src/question.svg" alt="">
                <h2>#<?php echo $inquirycount ?></h2>

            </div>

        </div>




        <div class="profileDetails">

            <div class="profileDetailsOverlay">
                <h1>Profile Details</h1>

                <form class="cdetailForm" action="updateManagerDetails.php" method="post">
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Manager ID: <input type="text" id="mngID" name="mngID" class="txtField" value="<?php echo $row['Manager_ID'] ?>" readonly></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Name: <input type="text" id="mngName" name="mngName" class="txtField" value="<?php echo $row['Manager_Name'] ?>" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Contact: <input type="text" id="contact" name="contact" class="txtField" value="<?php echo $row['Contact'] ?>" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Username: <input type="text" id="username" name="username" class="txtField" value="<?php echo $row['Username'] ?>" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> New Password: <input type="password" id="password" name="password" class="txtField" value="<?php echo $row['Manager_Password'] ?>" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Confirm New password: <input type="password" id="confirmPassword" name="confirmPassword" class="txtField" value="<?php echo $row['Manager_Password'] ?>" required></p><br>

                    <input type="submit" name="delete" class="dltButton" value="Delete" formnovalidate><br>
                    <input type="submit" name="submit" value="Update"><br>
                </form>
            </div>
        </div>
    </div>



</body>

</html>