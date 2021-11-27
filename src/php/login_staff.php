<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Staff Login Page </title>
    <link rel="stylesheet" href="../css/login_style.css">
</head>

<body>
    <div style="text-align: center;">
        <h1> Staff Log In </h1>
    </div>
    <form method = "POST" action = "login_staff.php">
        <div class="container">

        <input type="hidden" id="loginRequest" name="loginRequest">
            <section class="left">
                <label>Employee ID: </label>
            </section>
            <section>
                <input type="text" placeholder="Enter Employee ID" name="ID" required>
            </section>
            <section class="left">
                <label>Email: </label>
            </section>
            <section>
                <input type="text" placeholder="Enter email" name="email" required>
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

require ('dbUtilUBCServer.php');

function handleloginRequest() {
    global $db_conn;
    if (isset($_POST['id']) == false || isset($_POST['password']) == false
    || isset($_POST['email']) == false) {
        echo "You must fill out ID, email, and password";
        header("refresh:10");
    }

    $ID = $_POST['id'];
    $email = $_POST['email'];
    $psw = $_POST['password'];

    $sql_select = executePlainSQL("SELECT Count(*) FROM Account WHERE email = '$email' AND password = '$psw'");
    $logistic_staff = executePlainSQL("SELECT Count(*) FROM Logistic_Staff WHERE employee_ID = '$ID'");
    $customer_service = executePlainSQL("SELECT Count(*) FROM Customer_Service WHERE employee_ID = '$ID'");
    $results = oci_fetch_row($sql_select);
    $number  = (int)$results[0];
    if($number == 0 && ($row = oci_fetch_row($logistic_staff))[0] == 0 && ($row = oci_fetch_row($customer_service))[0] == 0) {
        echo "Sorry, the CUSTOMER account is not found!";
        header("refresh:1");
    } else if (($row = oci_fetch_row($logistic_staff))[0] != 0){
        // TODO jump to logistic_staff
        echo "loginRequest success";
        echo "<script type='text/javascript'> document.location = 'staff_logistic_main_page.php'; </script>";
    } else {
        $_SESSION['userName'] = $email;
        // TODO jump to customer_service
        echo "loginRequest success";
        echo "<script type='text/javascript'> document.location = 'staff_cs_main_page.php'; </script>";
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

