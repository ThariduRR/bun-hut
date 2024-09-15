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
$name = $_SESSION['managerUsername'];

if (isset($_POST['submit'])) {
    include('Connection.php');

    $mngID = $_POST['mngID'];
    $mngName = $_POST['mngName'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errorMessage = "";

    if ($name == '') {
        echo "<script>alert('Login as a manager before updating your profile '); window.location='managerLogin.html'</script>";
    } else {

        $number = preg_match('@[0-9]@', $confirmPassword);
        $uppercase = preg_match('@[A-Z]@', $confirmPassword);
        $lowercase = preg_match('@[a-z]@', $confirmPassword);
        $specialChars = preg_match('@[^\w]@', $confirmPassword);

        if (strlen($confirmPassword) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $errorMessage .= " Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }

        if (!empty($errorMessage)) {
            echo "<script>alert('$errorMessage.'); window.location='managerProfile.php'</script>";
        } else {

            if ($password == $confirmPassword) {
                $sql = "UPDATE managers set Manager_Name = '$mngName', Contact='$contact' ,  Username = '$username', Manager_Password='$confirmPassword' WHERE Manager_ID= '$mngID' ";

                $results = mysqli_query($conn, $sql);

                if (!$results) {
                    die('Unable to Update user details. Error: ' .
                        mysqli_error($conn));
                } else {
                    echo "<script>alert('Manager details updated'); window.location='managerProfile.php'</script>";
                }
            } else {
                echo "<script>alert('Password and Confirm Password Fields Dosent Match. Please Try again'); window.location='managerProfile.php'  </script>";
            }
        }
    }
} else if (isset($_POST['delete'])) {
    $managerID = $_POST['mngID'];


    $sql = "DELETE FROM managers WHERE Manager_ID   = '$managerID'";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to delete the manager from the database. Error: ' .
            mysqli_error($conn));
    } else {
        echo "<script>alert('Manager Deleted'); window.location='managerLogin.html'</script>";
    }
} else {
    echo "Please go back and fill out the form";
}

?>
</body>

</html>