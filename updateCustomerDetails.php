<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Customer Update</title>
</head>

<body>
</body>
<?php

include('Connection.php');
session_start();
$name = $_SESSION['username'];

if (isset($_POST['submit'])) {
    include('Connection.php');

    $customerId = $_POST['customerId'];
    $fullName = $_POST['customerName'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errorMessage = "";

    if ($name == '') {
        echo "<script>alert('Login to the system before updating your profile '); window.location='customerLogin.html'</script>";
    } else {

        $number = preg_match('@[0-9]@', $confirmPassword);
        $uppercase = preg_match('@[A-Z]@', $confirmPassword);
        $lowercase = preg_match('@[a-z]@', $confirmPassword);
        $specialChars = preg_match('@[^\w]@', $confirmPassword);



        if (strlen($confirmPassword) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $errorMessage .= " Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }

        if (!empty($errorMessage)) {
            echo "<script>alert('$errorMessage.'); window.location='customerProfile.php'</script>";
        } else {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($password == $confirmPassword) {
                    $sql = "UPDATE customers set Customer_Name = '$fullName', Address='$address', Email='$email', Mobile='$mobileNumber', Username='$username', User_Password='$confirmPassword' WHERE Customer_ID= '$customerId' ";

                    $results = mysqli_query($conn, $sql);

                    if (!$results) {
                        die('Unable to Update user details. Error: ' .
                            mysqli_error($conn));
                    } else {
                        echo "<script>alert('User details updated'); window.location='customerProfile.php'</script>";
                    }
                } else {
                    echo "<script>alert('Password and Confirm Password Fields Dosent Match. Please Try again'); window.location='customerProfile.php'</script>";
                }
            } else {
                echo "<script>alert('Invalid email format, Please try again'); window.location='customerProfile.php'</script>";
            }
        }
    }
} else {
    echo "Please go back and fill out the Register form";
}

?>
</body>

</html>