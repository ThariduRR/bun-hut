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
$orderID = $_SESSION['orderID'];

if (isset($_POST['submit'])) {
    include('Connection.php');

    $orderStatus = $_POST['orderStatus'];


    $sql = "UPDATE orders set Order_Status  = '$orderStatus' WHERE Order_ID= '$orderID' ";


    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to Update the Order Status. Error: ' .
            mysqli_error($conn));
    } else {
        echo "<script>alert('Order status updated'); window.location='viewOrders.php'</script>";
    }
} else if (isset($_POST['delete'])) {
    $orderId = $_SESSION['orderID'];


    $sql = "DELETE FROM orders WHERE Order_ID = '$orderId'";

    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die('Unable to Delete the Order from the database. Error: ' .
            mysqli_error($conn));
    } else {
        $sql2 = "DELETE FROM items WHERE Order_Id = '$orderId'";

        $results2 = mysqli_query($conn, $sql2);

        if (!$results2) {
            die('Unable to Delete items from database. Error: ' .
                mysqli_error($conn));
        } else {
            echo "<script>alert('Order Deleted'); window.location='viewOrders.php'</script>";
        }
    }
}
?>
</body>

</html>