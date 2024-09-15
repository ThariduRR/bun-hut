<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert Foods</title>
</head>

<body>
    <?php
    include("Connection.php");
    $errorMessage = "";
    session_start();
    if (isset($_SESSION['username'])) {
        $name = $_SESSION['username'];

        $nowDateTime = date("Y-m-d H");

        $sqltemp = 'SELECT Item_Qty from items where Item_Date = "' . $nowDateTime . '"';

        $resulttemp = mysqli_query($conn, $sqltemp);

        $total = 0;
        while ($rowtemp = mysqli_fetch_array($resulttemp)) {
            $total = $total + $rowtemp['Item_Qty'];
        }

        if ($total > 50) {
            echo "<script>alert('Restaurant is packed with orders. Please try in an Hour or Reduce your Item Quantity. Sorry for the Inconvenience'); window.location='home.html'</script>";
        } else {

            $cdate2 = date("Y-m-d");
            $cTime2 = date("h:i:sa");

            $sql = "INSERT INTO orders " .
                "(Customer_Name, Order_Date, Order_Time)" .
                "VALUES('$name', '$cdate2', '$cTime2')";

            $results = mysqli_query($conn, $sql);

            $last_id = mysqli_insert_id($conn);

            $_SESSION['lastId'] = $last_id;


            if (empty($_POST['tname']) || empty($_POST['tprice']) || empty($_POST['tqty']) || empty($_POST['timg']) || empty($_POST['tdate'])) {
                $errorMessage .= " Please fill out all the fields";
            }


            $tcount = $_POST['tcount'];




            for ($i = 0; $i < $tcount; $i++) {



                $tname = $_POST['tname' . strval($i)];
                $tprice = $_POST['tprice' . strval($i)];
                $tqty = $_POST['tqty' . strval($i)];
                $timg = $_POST['timg' . strval($i)];
                $tdate = $_POST['tdate' . strval($i)];

                $cDate = date("Y-m-d");
                $cTime = date("h:i:sa");
                $cDateTime = date("Y-m-d H");



                $sql = "INSERT INTO items " .
                    "(Order_Id, Item_Name, Item_Price, Item_Qty, Item_Img, Item_Date, Item_Time, Item_datetime, customer)" .
                    "VALUES('$last_id', '$tname', '$tprice', '$tqty', '$timg', '$cDate', '$cTime', '$cDateTime' ,'$name')";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                } else {
                    echo "<script>alert('Order Confirmed'); window.location='invoice.php'</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Login required to view the profile'); window.location='customerLogin.html'</script>";
    }




    ?>

</body>

</html>