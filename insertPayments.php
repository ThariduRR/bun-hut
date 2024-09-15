<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Insert Payment</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        include("Connection.php");
        $errorMessage = "";
        session_start();
        $lastId = $_SESSION['lastId'];



        if (empty($_POST['name']) || empty($_POST['expDate']) || empty($_POST['ccc'])) {
            $errorMessage .= " Please fill out all the fields";
        }


        $Nameoncd = $_POST['name'];
        $carNum = $_POST['cardNum'];
        $payment = $_POST['payment'];
        $bank = $_POST['bank'];
        $expDate = $_POST['expDate'];
        $ccc = $_POST['ccc'];


        if (!empty($errorMessage)) {
            echo "<script>alert('$errorMessage.'); </script>";
        } else {


            $sql = "INSERT INTO payments " .
                "(Payee_Name, Card_Number, Card_Type, Bank, Exp_Date, CCC, Order_ID)" .
                "VALUES('$Nameoncd', '$carNum','$payment', '$bank', '$expDate', '$ccc', '$lastId')";

            $results = mysqli_query($conn, $sql);

            if (!$results) {
                die('Unable to Insert the Food item to the database. Error: ' .
                    mysqli_error($conn));
            } else {
                echo "<script>alert('Order Confirmed'); window.location='Index.html'</script>";
            }
        }
    } else {
        echo "Please go back and fill out the Register form";
    }

    ?>

</body>

</html>