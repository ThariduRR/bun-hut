<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert Foods</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        include("Connection.php");
        $errorMessage = "";

        if (empty($_POST['foodName']) || empty($_POST['price']) || empty($_POST['ingredients'])) {
            $errorMessage .= " Please fill out all the fields";
        }

        $foodName = $_POST['foodName'];
        $foodCategory = $_POST['category'];
        $price = $_POST['price'];
        $ingredients = $_POST['ingredients'];

        if ($_FILES["image"]["error"] === 4) {
            echo "<script>alert('Image does not exist');'</script>";
        } else {

            if (!empty($errorMessage)) {
                echo "<script>alert('$errorMessage.'); window.location='foodItemsmng.html'</script>";
            } else {

                $fileName = $_FILES["image"]["name"];
                $fileSize = $_FILES["image"]["size"];
                $tmpName = $_FILES["image"]["tmp_name"];

                $validImageExtention = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode(".", $fileName);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validImageExtention)) {
                    echo "<script>alert('Invalid File Type');'</script>";
                } else if ($fileSize > 100000) {
                    echo "<script>alert('Too large file');'</script>";
                } else {
                    $newImageName = uniqid();
                    $newImageName .= '.' . $imageExtension;

                    move_uploaded_file($tmpName, 'img/' . $newImageName);

                    $sql = "INSERT INTO foods " .
                        "(Food_Name, Food_Category, Food_Price, Food_Ingredients, Food_Image)" .
                        "VALUES('$foodName', '$foodCategory', '$price', '$ingredients', '$newImageName')";

                    $results = mysqli_query($conn, $sql);

                    if (!$results) {
                        die('Unable to Insert the Food item to the database. Error: ' .
                            mysqli_error($conn));
                    } else {
                        echo "<script>alert('Food Item added'); window.location='foodItemsmng.php'</script>";
                    }
                }
            }
        }
    } else {
        echo "Please go back and fill out the Register form";
    }

    ?>

</body>

</html>