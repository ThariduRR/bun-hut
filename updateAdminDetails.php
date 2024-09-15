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
$name = $_SESSION['adminUsername'];

if (isset($_POST['submit'])) {
    include('Connection.php');

    $adminID = $_POST['adminId'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errorMessage = "";

    if ($name == '') {
        echo "<script>alert('Login as a admin before updating your profile '); window.location='adminLogin.html'</script>";
    } else {

        $number = preg_match('@[0-9]@', $confirmPassword);
        $uppercase = preg_match('@[A-Z]@', $confirmPassword);
        $lowercase = preg_match('@[a-z]@', $confirmPassword);
        $specialChars = preg_match('@[^\w]@', $confirmPassword);

        if (strlen($confirmPassword) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $errorMessage .= " Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }

        if (!empty($errorMessage)) {
            echo "<script>alert('$errorMessage.'); window.location='adminProfile.php'</script>";
        } else {

            if ($password == $confirmPassword) {
                $sql = "UPDATE admins set Username = '$username', Admin_Password='$confirmPassword'WHERE Admin_ID= '$adminID' ";

                $results = mysqli_query($conn, $sql);

                if (!$results) {
                    die('Unable to Update user details. Error: ' .
                        mysqli_error($conn));
                } else {
                    echo "<script>alert('Admin details updated'); window.location='adminProfile.php'</script>";
                }
            } else {
                echo "<script>alert('Password and Confirm Password Fields Dosent Match. Please Try again'); window.location='adminProfile.php'  </script>";
            }
        }
    }
} else if (isset($_POST['delete'])) {
    $adminID = $_POST['adminId'];


    $sql = "DELETE FROM admins WHERE Admin_ID  = '$adminID'";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to delete the admin from the database. Error: ' .
            mysqli_error($conn));
    } else {
        echo "<script>alert('Admin Deleted'); window.location='adminLogin.html'</script>";
    }
} else {
    echo "Please go back and fill out the form";
}

?>
</body>

</html>