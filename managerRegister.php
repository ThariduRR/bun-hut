<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manager Register</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        include("Connection.php");
        $errorMessage = "";

        if (empty($_POST['fullname']) || empty($_POST['contact']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirmPassword'])) {
            $errorMessage .= " Please fill out all the fields";
        }


        $fullName = $_POST['fullname'];
        $contact = $_POST['contact'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $number = preg_match('@[0-9]@', $confirmPassword);
        $uppercase = preg_match('@[A-Z]@', $confirmPassword);
        $lowercase = preg_match('@[a-z]@', $confirmPassword);
        $specialChars = preg_match('@[^\w]@', $confirmPassword);

        if (strlen($confirmPassword) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
            $errorMessage .= " Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
        }


        if ($password == $confirmPassword) {
            if (!empty($errorMessage)) {
                echo "<script>alert('$errorMessage.'); window.location='manageManagers.php'</script>";
            } else {

                $sql = "INSERT INTO managers " .
                    "(Manager_Name, Contact, Username, Manager_Password)" .
                    "VALUES('$fullName', '$contact', '$username', '$confirmPassword')";

                $results = mysqli_query($conn, $sql);

                if (!$results) {
                    die('Unable to Regsiter the Manager. Error: ' .
                        mysqli_error($conn));
                } else {
                    echo "<script>alert('Manager Added'); window.location='manageManagers.php'</script>";
                }
            }
        } else {
            echo "<script>alert('Password and Confirm Password Fields Dosent Match. Please Try again'); window.location='manageManagers.php'</script>";
        }
    } else {
        echo "Please go back and fill out the Register form";
    }

    ?>


</body>

</html>