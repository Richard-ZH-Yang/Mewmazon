<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Seller main page </title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>

<body>
<div style="text-align: center;">
    <h1> Welcome </h1>

    <hr/>

</div>
<form action="customer_home_page.php" method="post">
    <div class="container">

        <h2>Update Password</h2>

        <form method="POST" action="customer_home_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="addProductRequest" name="addProductRequest">
            <!-- <input type="text" placeholder="seller email" name="email" id="email" required><br> -->
            <input type="text" placeholder="Old Password" name="oldpsw" id="oldpsw" required><br>
            <input type="text" placeholder="New Password" name="newpsw" id="newpsw" required><br>
            <input type="submit" value="updateSubmit" name="updateSubmit"><br>
        </form>

        <hr/>

        <form method="GET" action="customer_home_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="showLowestAvg" name="showLowestAvg">
            <button type="submit" value="showLowestAvg" name="showLowestAvg">Show Product with cheapest Average Price</button>
        </form>

        <hr/>

    </div>
</form>

<?php

require('dbUtilUBCServer.php');
if ($_GET['ID']) {
    $globalID = $_GET['ID'];
    echo $globalID;
}


function printResult($result)
{ //prints results from a select statement
    echo "<br>Product with lowest average from product table:<br>";
    echo "<table>";
    echo "<tr><th>Product Name</th><th></th><th>Average Price</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NAME"] ."</td><td>" . $row["PRICE"] . "</td></tr>";
    }

    echo "</table>";
}

function printDistinctProduct($result) {
    echo "<br>Product from product table:<br>";
    echo "<table>";
    echo "<tr><th>Product Name</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NAME"] . "</td></tr>";
    }

    echo "</table></br>";
}

function handleUppdateRequest($globalID)
{
    global $db_conn;
    global $globalID;

    // $temp = $GLOBALS['globalID'];

    echo $globalID;
    echo gettype($temp);

    if (isset($_POST['productName']) == false || isset($_POST['parcelDimension']) == false) {
        echo "You must fill all blanks!";
        header("refresh:10");
    }

    $psw = executePlainSQL("SELECT password FROM Account WHERE email_address='$email'");
    $temp = OCI_Fetch_Array($psw, OCI_BOTH);
    $origpsw = $temp['PASSWORD'];
    $oldpsw = $_POST['oldpsw'];
    $newpsw = $_POST['newpsw'];

    if ($origpsw != $oldpsw) {
        echo "you old password dosen't match, please try again!";
    } else {
        executeBoundSQL("UPDATE Account SET password = '$newpsw'");
        echo "update success!";
    }


    OCICommit($db_conn);
}

function handleShowLowestAvgRequest()
{
    global $db_conn;
    global $globalID;
    $result = executePlainSQL("SELECT name, AVG(price) name FROM Products_Post p1 GROUP BY p1.name HAVING AVG(p1.price) <= ALL (SELECT AVG(p2.price) FROM Products_Post p2 GROUP BY p2.price)");
    printResult($result);
    OCICommit($db_conn);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest($globalID)
{
    if (connectToDB()) {
        if (array_key_exists('addProductRequest', $_POST)) {
            handleUppdateRequest($globalID);
        } else if (array_key_exists('deleteProduct', $_POST)) {
            handleDeleteProduct();
        }
        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest()
{
    if (connectToDB()) {
        if (array_key_exists('showLowestAvg', $_GET)) {
            handleShowLowestAvgRequest();
        }
        disconnectFromDB();
    }
}

if (isset($_POST['updateSubmit'])) {
    handlePOSTRequest();
} else if (isset($_GET['showLowestAvg'])) {
    handleGETRequest();
}

if (connectToDB()) {
    global $db_conn;
    $result = executePlainSQL("SELECT DISTINCT name FROM products_post");
    printDistinctProduct($result);

}
?>


</body>

</html>
