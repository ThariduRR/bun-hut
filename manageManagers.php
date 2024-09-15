<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Burger Hub</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="manageManagers.css">

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


    <div class="content">

        <h1 class="heading"> Manage Managers </h1>


        <div class="regForm">
            <div class="regFormOverlay">
                <h1>Manager Register</h1>
                <p>Enter Manager details below</p>
                <form class="" action="managerRegister.php" method="post">
                    <input type="text" placeholder="Full Name" id="fullname" name="fullname" required>
                    <input type="text" placeholder="Contact" id="contact" name="contact" required>
                    <input type="text" placeholder="Username" id="username" name="username" required>
                    <input type="password" placeholder="Password" id="password" name="password" required>
                    <input type="password" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword" required>

                    <input type="Submit" name="submit" value="Add a new Manager">
                </form>
            </div>
        </div>

        <h1 class="heading">Available Managers</h1>
        <div class="line"></div>
        <div class="managerTable">

            <?php
            include 'Connection.php';
            $sql = "SELECT * FROM managers";
            $result = mysqli_query($conn, $sql);

            echo "<table border = 1>";
            echo "<tr>";
            echo "<th> Manager ID </th>";
            echo "<th> Manager name </th>";
            echo "<th> Contact </th>";
            echo "<th> Username </th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($result)) {

                echo "<tr>";
                echo "<td>" . $row['Manager_ID'] . "</td>";
                echo "<td>" . $row['Manager_Name'] . "</td>";
                echo "<td>" . $row['Contact'] . "</td>";
                echo "<td>" . $row['Username'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($conn);
            ?>

        </div>
    </div>



</body>

</html>