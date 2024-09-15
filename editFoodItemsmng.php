<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="editFoodItems.css">

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
                    <a href="managerProfile.php" class="logo">
                        <img src="images/BunHutLogo.png" alt="">
                        <span class="nav-item">Admin Menu</span>
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
    $name = $_GET['name'];
    $_SESSION['foodName'] = $_GET['name'];


    if ($name == '') {
        echo "<script>alert('Couldn't fetch data for the provided username'); window.location='foodItems.php'</script>";
    } else {

        $sql = 'SELECT * FROM foods where Food_Name = "' . $name . '"';

        $result = mysqli_query($conn, $sql) or
            die("Couldn't execute query." . mysqli_error($conn));

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
        }
    }

    ?>

    <div class="content">

        <h1 class="heading"> Update Food items </h1>
        <div class="line2"></div>

    </div>


    <div class="foodDetails">

        <div class="foodDetailsOverlay">
            <h1>Food Details</h1>
            <p>Enter food details</p>
            <form class="cdetailForm" action="updateFoodDetailsmng.php" method="post" enctype="multipart/form-data">
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food ID: <input type="text" id="foodId" name="foodId" class="txtField" value="<?php echo $row['Food_Id'] ?>" readonly></p><br>
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food Name: <input type="text" id="foodName" name="foodName" class="txtField" value="<?php echo $row['Food_Name'] ?>" required></p><br><br>
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food Category: <select name="category" id="category">
                        <option value="Burgers"><?php echo $row['Food_Category'] ?></option>

                        <?php


                        $testResult = mysqli_query($conn, "SELECT * FROM categories");

                        while ($row2 = mysqli_fetch_array($testResult)) {
                            echo "<option value='" . $row2['Category_Name'] . "'> " . $row2['Category_Name'] . '</option>';
                        }

                        ?>

                    </select>
                </p>
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food Price: <input type="text" id="foodPrice" name="foodPrice" class="txtField" value="<?php echo $row['Food_Price'] ?>" required></p><br><br>
                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food Ingredients: <textarea name="ingredients" id="ingredients" rows="5" cols="30" placeholder="Food Ingredients" required><?php echo $row['Food_Ingredients'] ?></textarea></p><br>


                <p style="font-family: 'Raleway'; color:white; font-size:20px; margin-left: 80px; text-align: left;"> Food Image: <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png*"></p><br><br>

                <img src="img/<?php echo $row['Food_Image'] ?>" alt="<?php echo $row['Food_Image'] ?>">

                <input type="submit" name="delete" value="Delete" style="float:left; margin-top: 25px;"><br>
                <input type="submit" name="submit" value="Update"><br>
            </form>
        </div>
    </div>
    </div>



</body>

</html>