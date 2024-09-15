<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Update</title>
</head>

<body>
</body>
<?php

include('Connection.php');
session_start();
$name = $_SESSION['foodName'];

if (isset($_POST['submit'])) {
    include('Connection.php');

    $foodId = $_POST['foodId'];
    $foodName = $_POST['foodName'];
    $category = $_POST['category'];
    $foodPrice = $_POST['foodPrice'];
    $ingredients = $_POST['ingredients'];
    $image = $_FILES["image"]["name"];

    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        if ($_FILES["image"]["error"] === 4) {
            echo "<script>alert('Image does not exist');'</script>";
        } else {

            if (!empty($errorMessage)) {
                echo "<script>alert('with image.'); window.location='foodItems.html'</script>";
            } else {

                $fileName = $_FILES["image"]["name"];
                $fileSize = $_FILES["image"]["size"];
                $tmpName = $_FILES["image"]["tmp_name"];

                $validImageExtention = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode(".", $fileName);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validImageExtention)) {
                    echo "<script>alert('Invalid File Type');'</script>";
                } else if ($fileSize > 1000000) {
                    echo "<script>alert('Too large file');'</script>";
                } else {
                    $newImageName = uniqid();
                    $newImageName .= '.' . $imageExtension;

                    move_uploaded_file($tmpName, 'img/' . $newImageName);

                    $sql = "UPDATE foods set Food_Id  = '$foodId', Food_Name='$foodName' ,Food_Category='$category' ,Food_Price='$foodPrice' ,Food_Ingredients='$ingredients' ,Food_Image='$newImageName' WHERE Food_Id= '$foodId' ";


                    $results = mysqli_query($conn, $sql);

                    if (!$results) {
                        die('Unable to Update the Food item. Error: ' .
                            mysqli_error($conn));
                    } else {
                        echo "<script>alert('Food Update with the Image'); window.location='foodItems.php'</script>";
                    }
                }
            }
        }
    } else {

        $sql = "UPDATE foods set Food_Id  = '$foodId', Food_Name='$foodName' ,Food_Category='$category' ,Food_Price='$foodPrice' ,Food_Ingredients='$ingredients' WHERE Food_Id= '$foodId' ";

        $results = mysqli_query($conn, $sql);

        if (!$results) {
            die('Unable to Insert the Food item to the database. Error: ' .
                mysqli_error($conn));
        } else {
            echo "<script>alert('Food details updated without image');window.location='foodItems.php' </script>";
        }
    }
} else if (isset($_POST['delete'])) {
    $foodName = $_POST['foodName'];


    $sql = "DELETE FROM foods WHERE Food_Name = '$foodName'";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to Insert the Food item to the database. Error: ' .
            mysqli_error($conn));
    } else {
        echo "<script>alert('Food Item Deleted'); window.location='foodItems.php'</script>";
    }
} else {
    echo "<script>alert('Go back and Fill out the Update form');window.location='foodItems.php' </script>";
}

?>
</body>

</html>