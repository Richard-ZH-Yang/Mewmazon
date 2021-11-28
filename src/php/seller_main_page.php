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
<form action="seller_main_page.php" method="post">
    <div class="container">

        <h2>Add product into Product table</h2>

        <form method="POST" action="seller_main_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="addProductRequest" name="addProductRequest">
            <!-- <input type="text" placeholder="seller email" name="email" id="email" required><br> -->
            <input type="text" placeholder="product name" name="productName" id="productName" required><br>
            <input type="text" placeholder="parcel dimension" name="parcelDimension" id="parcelDimension" required><br>
            <input type="text" placeholder="product price" name="productPrice" id="productPrice" required><br>
            <input type="submit" value="addProductRequest" name="addProductRequest"><br>
        </form>

        <h2>Delete product from Product table</h2>

        <form method="GET" action="seller_main_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteProductRequest" name="deleteProductRequest">
            <input type="text" placeholder="product ID" name="productID" id="productID" required><br>
            <button type="submit" value="deleteProduct" name="deleteProduct">Delete</button>
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
    echo "<br>Retrieved data from product table:<br>";
    echo "<table>";
    echo "<tr><th>Product ID</th><th>Sller ID</th><th>Producr Name</th><th>Parcel Dimension</th></tr>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
        echo "<tr><td>" . $row["PRODUCT_ID"] . "</td><td>" . $row["SELLER_ID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["PARCEL_DIMENSION"] . "</td></tr>";
    }

    echo "</table>";
}

function handleAddProductRequest($globalID)
{
    global $db_conn;
    global $globalID;

    // $temp = $GLOBALS['globalID'];

    echo $globalID;
    echo gettype($temp);

    if (isset($_POST['productName']) == false || isset($_POST['parcelDimension']) == false
        || isset($_POST['productPrice']) == false) {
        echo "You must fill all blanks!";
        header("refresh:10");
    }


    $tuple = array(
        ":bind1" => uniqid(),
        ":bind2" => $globalID,
        ":bind3" => $_POST['productName'],
        ":bind4" => $_POST['parcelDimension'],
        ":bind5" => 'AVAILABLE',
        ":bind6" => $_POST['productPrice']
    );

    $alltuples = array(
        $tuple
    );

    executeBoundSQL("insert into products_post values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
    OCICommit($db_conn);
}

function handleDeleteProduct()
{
    global $db_conn;
    echo "delete product";
    if (isset($_POST['productID']) == false) {
        echo "You must fill all blanks!";
        header("refresh:10");
    }
    $productID = $_POST['productID'];
    $result = "DELETE FROM products_post WHERE product_ID = '$productID'";
    executePlainSQL($result);
    OCICommit($db_conn);
}

function handleShowProductRequest($globalID)
{
    global $db_conn;
    $result = executePlainSQL("SELECT * FROM products_post WHERE seller_ID = '$globalID'");
    printResult($result);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest($globalID)
{
    if (connectToDB()) {
        if (array_key_exists('addProductRequest', $_POST)) {
            handleAddProductRequest($globalID);
        } else if (array_key_exists('deleteProduct', $_POST)) {
            handleDeleteProduct();
        }
        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest($globalID)
{
    if (connectToDB()) {
        if (array_key_exists('showProduct', $_GET)) {
            handleShowProductRequest($globalID);
        }
        disconnectFromDB();
    }
}

if ((isset($_POST['addProductRequest']) || isset($_POST['deleteProduct']))) {
    global $globalID;
    handlePOSTRequest($globalID);
} else if (isset($_GET['showProductRequest'])) {
    global $globalID;
    handleGETRequest($globalID);
}

if (connectToDB()) {
    global $db_conn;
    $result = executePlainSQL("SELECT * FROM products_post WHERE seller_ID = '$globalID'");
    printResult($result);
    echo "<br><tr><th>Number of Avalibale Products</th></tr><br>";
    $result1 = executePlainSQL("SELECT count(*) FROM products_post GROUP BY products_post.status HAVING products_post.status = 'AVAILABLE'");
    if (($row = oci_fetch_row($result)) != false) {
        echo "<tr><td>" . $row[0] . "</td></tr>";
    }
    echo "<br><tr><th>Number of Processing Products</th></tr><br>";
    $result1 = executePlainSQL("SELECT count(*) FROM products_post GROUP BY products_post.status HAVING products_post.status = 'PROCESS'");
    if (($row = oci_fetch_row($result)) != false) {
        echo "<tr><td>" . $row[0] . "</td></tr>";
    }

}


?>


</body>

</html>
