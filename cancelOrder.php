<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Orer Cancel</title>
</head>

<body>
</body>
<?php

include('Connection.php');
session_start();
$orderID = $_SESSION['orderID'];



if (isset($_POST['submit'])) {
    include('Connection.php');

    $cancel = $_POST['cancel'];

    $canceled = "Canceled";

    echo "<script>alert('$orderID')</script>";


    $sql = "UPDATE orders set Canceled_Reason = '$cancel', Order_Status='$canceled' WHERE Order_ID= '$orderID' ";


    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to Update the Order Status. Error: ' .
            mysqli_error($conn));
    } else {
        echo "<script>alert('Order canceled'); window.location='customerProfile.php'</script>";
    }
}
?>
</body>

</html>