<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="adminProfile.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=REM:wght@600&display=swap" rel="stylesheet">
    <!-- Swiper library-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php
    include('Connection.php');
    session_start();

    if (isset($_SESSION['adminUsername'])) {
        if ($_SESSION['adminUsername'] == '') {
            echo "<script>alert('Couldn't fetch data for the provided username'); window.location='adminLogin.html'</script>";
        }
    }
    ?>
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


    <div class="content">

        <h1 class="heading"> Admin Dashboard </h1>
        <div class="line2"></div>


        <div class="bar">

            <div class="element1">

                <?php
                include 'Connection.php';

                $today = date("Y-m-d");

                $sql = 'SELECT * FROM orders where Order_Date = "' . $today . '"';
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


        <h1 class="heading" style="font-size:30px;">Customer inquiries</h1>

        <div class="section3">

            <?php
            include 'Connection.php';
            $sql = "SELECT * FROM inquiries";
            $result = mysqli_query($conn, $sql);

            echo "<table border = 1>";
            echo "<tr>";
            echo "<th> Inquiry ID  </th>";
            echo "<th> Customer Name </th>";
            echo "<th> Email </th>";
            echo "<th> Number </th>";
            echo "<th> Inquiry </th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {

                echo "<tr>";
                echo "<td>" . $row['Inq_ID'] . "</td>";
                echo "<td>" . $row['Full_Name'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Number'] . "</td>";
                echo "<td>" . $row['Inquiry'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($conn);
            ?>


        </div>



        <div class="profileDetails">
            <?php
            include('Connection.php');


            if (isset($_SESSION['adminUsername'])) {
                if ($_SESSION['adminUsername'] == '') {
                    echo "<script>alert('Couldn't fetch data for the provided username'); window.location='adminLogin.html'</script>";
                } else {
                    $name = $_SESSION['adminUsername'];
                    $sql = 'SELECT * FROM admins where Username = "' . $name . '"';

                    $result = mysqli_query($conn, $sql) or
                        die("Couldn't execute query." . mysqli_error($conn));

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                    }
                }
            } else {
                echo "<script>alert('Login required to view the profile'); window.location='adminLogin.html'</script>";
            }


            ?>

            <div class="profileDetailsOverlay">
                <h1>Profile Details</h1>

                <form class="cdetailForm" action="updateAdminDetails.php" method="post">
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Customer ID: <input type="text" id="adminId" name="adminId" class="txtField" value="<?php echo $row['Admin_ID'] ?>" readonly></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Username: <input type="text" id="username" name="username" class="txtField" value="<?php echo $row['Username'] ?>" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> New Password: <input type="password" id="password" name="password" class="txtField" required></p><br>
                    <p style="font-family: 'Raleway'; color:WHITE; font-size:20px; margin-left: 80px;"> Confirm New password: <input type="password" id="confirmPassword" name="confirmPassword" class="txtField" required></p><br>

                    <input type="submit" name="delete" class="dltButton" value="Delete" formnovalidate><br>
                    <input type="submit" name="submit" value="Update"><br>
                </form>
            </div>
        </div>
    </div>



</body>

</html>