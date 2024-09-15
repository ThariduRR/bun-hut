<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Customer Order Login Check</title>
</head>

<body>
</body>
<?php

//Stop Unidenfied syntax error from showing
set_error_handler(function (int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);

include('Connection.php');
session_start();
$name = $_SESSION['username'];
if ($name == '') {
    echo "<script>alert('Login to the system is required for ordering'); window.location='customerLogin.html'</script>";
} else {
    echo "<script>window.location='order.php'</script>";
}

?>
</body>

</html>