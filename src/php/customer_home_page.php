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
            <input type="hidden" id="updatePassword" name="updatePassword">
            <input type="text" placeholder="Email" name="email" id="email" required><br>
            <input type="text" placeholder="Old Password" name="oldpsw" id="oldpsw" required><br>
            <input type="text" placeholder="New Password" name="newpsw" id="newpsw" required><br>
            <input type="submit" value="update" name="updateSubmit"><br>
        </form>

        <hr/>

        <form method="GET" action="customer_home_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="showLowestAvg" name="showLowestAvg">
            <button type="submit" value="showLowestAvg" name="showLowestAvg">Show Product with cheapest Average Price</button>
        </form>

        <hr/>

        <form method="GET" action="customer_home_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="showProductSelledByAllSellers" name="showProductSelledByAllSellers">
            <input type="text" placeholder="product name" name="productName" id="productName" required><br>
            <button type="submit" value="showProductSelledByAllSellers" name="showProductSelledByAllSellers">Show all sellers that sell this product</button>
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
        echo "<tr><td>" . $row[0] ."</td><td>" . $row[1] . "</td></tr>";
    }

    echo "</table>";
}

function handleUppdateRequest()
{
    global $db_conn;



    $email = $_POST['email'];
    $oldpsw = $_POST['oldpsw'];
    $newpsw = $_POST['newpsw'];
    $sql_select = executePlainSQL("SELECT Count(*) FROM Account INNER JOIN Customers_Have_2 ON Account.email_address = Customers_Have_2.email_address WHERE Account.email_address= '$email' AND password = '$oldpsw'");
    $results = oci_fetch_row($sql_select);
    $number  = $results[0];

    if ($number == 0) {
        echo "you old password dosen't match, please try again!";
    } else {
        executePlainSQL("UPDATE Account SET PASSWORD = '$newpsw' WHERE email_address = '$email'");
    }

    
    OCICommit($db_conn);
}

function handleShowLowestAvgRequest()
{
    global $db_conn;
    $result = executePlainSQL("SELECT p1.name, AVG(price) name FROM Products_Post p1 GROUP BY p1.name HAVING AVG(p1.price) <= ALL (SELECT AVG(p2.price) FROM Products_Post p2 GROUP BY p2.name)");
    printResult($result);
    OCICommit($db_conn);
}

function handleShowProductSelledByAllSellers()
{
    global $db_conn;
    $name = $_GET['productName'];
    $result = executePlainSQL("SELECT s.name
    FROM Sellers s
    WHERE NOT EXISTS ((SELECT DISTINCT s1.name
                                       FROM Sellers s1)
                                       MINUS 
                                       (SELECT DISTINCT s2.name
                                        FROM Products_Post p1, Sellers s2
                                        WHERE s.ID = p1.seller_ID AND p1.name = '$name'))");

    echo "<br>All sellers sell this product:<br>";
    echo "<table>";
    echo "<tr><th>Seller Name</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NAME"] . "</td></tr>";
    }
    OCICommit($db_conn);
}



// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest()
{
    if (connectToDB()) {
        if (array_key_exists('updatePassword', $_POST)) {
            handleUppdateRequest();
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
        } else if (array_key_exists('showProductSelledByAllSellers', $_GET)){
            handleShowProductSelledByAllSellers();
        }
        disconnectFromDB();
    }
}

if (isset($_POST['updateSubmit'])) {
    handlePOSTRequest();
} else if (isset($_GET['showLowestAvg']) ||isset($_GET['showProductSelledByAllSellers'])) {
    handleGETRequest();
}

if (connectToDB()) {
    global $db_conn;
    $result = executePlainSQL("SELECT DISTINCT name FROM products_post");

    echo "<br>Products from product table:<br>";
    echo "<table>";
    echo "<tr><th>Product Name</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["NAME"] . "</td></tr>";
    }
}
?>


</body>

</html>
