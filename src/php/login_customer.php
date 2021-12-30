<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Customer Login Page </title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>

<body>
<div style="text-align: center;">
    <h1> Customer Log In </h1>
</div>
<form method = "POST" action = "login_customer.php">
    <div class="container">

        <input type="hidden" id="loginRequest" name="loginRequest">
        <section class="left">
            <label>Email: </label>
        </section>
        <section>
            <input type="text" placeholder="Enter Email" name="email" required>
        </section>
        <section class="left">
            <label>Password: </label>
        </section>
        <section>
            <input type="password" placeholder="Enter Password" name="password" required>
        </section>

        <div class="buttons">
            <input class="btn1" type="submit" name="login_submit" value="Login">
            <input class="btn2" type="button" value="Cancel" onclick="history.back(-1)" />
        </div>

    </div>
</form>
<?php

require('dbUtilUBCServer.php');

function handleloginRequest() {
    global $db_conn;
    if (isset($_POST['email']) == false || isset($_POST['password']) == false) {
        echo "You must fill put emial and password";
    }

    $email = $_POST['email'];
    $psw = $_POST['password'];

    // $sql_select = executePlainSQL("SELECT Count(*) FROM Account WHERE email_address = '$email' AND password = '$psw'");
    $sql_select = executePlainSQL("SELECT Count(*) FROM Account INNER JOIN Customers_Have_2 ON Account.email_address = Customers_Have_2.email_address WHERE Account.email_address= '$email' AND password = '$psw'");
    // $result1 = executePlainSQL("SELECT Count(*) FROM Customers_Have_2 WHERE email_address = '$email'");
    $results = oci_fetch_row($sql_select);
    $number  = (int)$results[0];
    if($number == 0) {
        echo "Sorry, the CUSTOMER account is not found!";
    } else {
        // TODO jump to customer
        echo "loginRequest success";
        echo "<script type='text/javascript'> document.location = 'customer_home_page.php?email=$email'; </script>";
    }




    OCICommit($db_conn);
}
// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('loginRequest', $_POST)) {
            handleloginRequest();
        }
        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('showProduct', $_GET)) {
            handleShowProductRequest();
        }
        disconnectFromDB();
    }
}

if (isset($_POST['login_submit'])) {
    handlePOSTRequest();
} else if (isset($_GET['showProductRequest'])) {
    handleGETRequest();
}
?>


</body>

</html>

