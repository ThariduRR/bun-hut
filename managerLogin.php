<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manager Login Validation</title>
</head>

<body>
</body>
<?php
if (count($_POST) > 0) {
    include 'Connection.php';
    $errorMessage = "";

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errorMessage .= "Please fill out all the fields";
    }

    $username = $_POST["username"];
    $password = $_POST["password"];


    if (!empty($errorMessage)) {
        echo "<script type='text/javascript'>
  alert('$errorMessage');</script>";
    } else {
        $sql = "SELECT * FROM managers WHERE Username='$username' and Manager_Password='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['managerUsername'] = $_POST['username'];
            echo "<script>alert('Logged in as Manager'); window.location='managerprofile.php' </script>";
        } else {
            echo "<script>alert('Invalid admin username or password. Try Again!'); window.location='managerLogin.html'</script>";
        }
    }
} else {
    echo "Fill out the Login Form";
}
?>
</body>

</html>