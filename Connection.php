<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Database connect</title>
</head>

<body>

    <?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if (!$conn) {
        die('Could not connect to the Database. Error: ' . mysqli_error($conn));
    }

    $db = mysqli_select_db($conn, 'bun-hut');

    if (!$db) {
        echo "<br>";
        echo 'Couldnt select the database. Please check again and select the correct database';
        echo "<br>";
    }

    ?>
</body>

</html>