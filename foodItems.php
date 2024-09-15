<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bun Hut</title>

    <!-- Style sheet -->
    <link rel="stylesheet" href="foodItems.css">

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

        <h1 class="heading"> Manage Food Items </h1>
        <div class="line2"></div>



        <div class="regForm">
            <div class="regFormOverlay">
                <h1>Add Food items</h1>
                <p>Enter food details</p>
                <form class="" action="insertFood.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Food name" id="foodName" name="foodName" required>
                    <br>
                    <select name="category" id="category">

                        <?php

                        include('Connection.php');

                        $result = mysqli_query($conn, "SELECT * FROM categories");

                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['Category_Name'] . "'> " . $row['Category_Name'] . '</option>';
                        }

                        ?>

                    </select>
                    <input type="text" placeholder="Food Price (Rs)" id="price" name="price" required>
                    <textarea name="ingredients" id="ingredients" rows="5" cols="30" placeholder="Food Ingredients" required></textarea>

                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png*" required>

                    <input type="Submit" name="submit" value="Add the food item">
                </form>
            </div>
        </div>


        <div class="regForm">
            <div class="regFormOverlay">
                <h1>Add Food Categries</h1>
                <p>Enter Category details</p>
                <form class="" action="insertCategory.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Category name" id="ctName" name="ctName" required>
                    <br>

                    <textarea name="ctDecs" id="ctDecs" rows="5" cols="30" placeholder="Category Description" required></textarea>


                    <input type="Submit" name="submit" value="Add Category">
                </form>
            </div>
        </div>


        <div class="foods">
            <div class="foodoverlay">


                <?php
                include 'Connection.php';
                $sql = "SELECT * FROM foods";
                $result = mysqli_query($conn, $sql);

                ?>



                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>



                    <div class="dish1" onclick="window.location.href = 'editFoodItems.php?name=<?php echo $row['Food_Name']; ?>'">
                        <img src="img/<?php echo $row['Food_Image']; ?>" alt="<?php echo $row['Food_Name']; ?>">
                        <h2><?php echo $row['Food_Name']; ?></h2>
                        <h3>Category</h3>
                        <p><?php echo $row['Food_Category']; ?></p>
                        <h3>Ingredients</h3>
                        <p><?php echo $row['Food_Ingredients']; ?></p>
                        <h2>Rs <?php echo $row['Food_Price']; ?>.00</h2>
                    </div>

                <?php

                }


                ?>

            </div>
        </div>


    </div>



</body>

</html>