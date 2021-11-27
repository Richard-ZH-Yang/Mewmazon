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
            <input type="submit" value="addSubmit" name="addSubmit"></p >
        </form>

        <h2>Delete product from Product table</h2>

        <form method="GET" action="seller_main_page.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteProductRequest" name="deleteProductRequest">
            <input type="text" placeholder="product ID" name="productID" id="productID" required><br>
            <button type="submit" value="deleteProduct" name="deleteProduct">Delete</button>
        </form>

        <hr/>
        <form method="GET" action="seller_main_page.php">
            <h2>Show your current product</h2>
            <input type="hidden" id="showProductRequest" name="showProductRequest">
            <button type="submit" name="showProduct">Show</button>
        </form>

        <hr/>

    </div>
</form>

<?php

require('dbUtilUBCServer.php');

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

function handleAddProductRequest()
{
    global $db_conn;

    if (isset($_POST['productName']) == false || isset($_POST['parcelDimension']) == false) {
        echo "You must fill all blanks!";
        header("refresh:10");
    }

    //Getting the values from user and insert data into the table
    $tuple = array(
        ":bind1" => uniqid(),
        ":bind2" => $_POST['sellerID'],
        ":bind3" => $_POST['productName'],
        ":bind4" => $_POST['parcelDimension'],
        ":bind5" => ""
    );

    $alltuples = array(
        $tuple
    );

    executeBoundSQL("insert into products_post values (:bind1, :bind2, :bind3, :bind4, :bind5)", $alltuples);
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

function handleShowProductRequest()
{
    global $db_conn;
    $sellerID = $_GET['sellerID'];
    $result = executePlainSQL("SELECT * FROM products_post WHERE seller_ID = '$sellerID'");
    printResult($result);
}

// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest()
{
    if (connectToDB()) {
        if (array_key_exists('addProductRequest', $_POST)) {
            handleAddProductRequest();
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
        if (array_key_exists('showProduct', $_GET)) {
            handleShowProductRequest();
        }
        disconnectFromDB();
    }
}

if (isset($_POST['reset']) || isset($_POST['addProductRequest']) || isset($_POST['deleteProduct'])) {
    handlePOSTRequest();
} else if (isset($_GET['showProductRequest'])) {
    handleGETRequest();
}
?>


</body>

</html>
