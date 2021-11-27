<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Staff Login Page </title>
    <!-- <link rel="stylesheet" href="all_css/login_style.css"> -->
</head>

<body>
    <center>
        <h1> Staff Log In </h1>  
    </center>
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

$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = NULL; // edit the loginRequest credentials in connectToDB()
$show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

function debugAlertMessage($message) {
    global $show_debug_alert_messages;

    if ($show_debug_alert_messages) {
        echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    }
}

function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;

    $statement = OCIParse($db_conn, $cmdstr);
    //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
        echo htmlentities($e['message']);
        $success = False;
    }

    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
        echo htmlentities($e['message']);
        $success = False;
    }

 return $statement;
}

function executeBoundSQL($cmdstr, $list) {
    /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
In this case you don't need to create the statement several times. Bound variables cause a statement to only be
parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
See the sample code below for how this function is used */

 global $db_conn, $success;
 $statement = OCIParse($db_conn, $cmdstr);

    if (!$statement) {
        echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($db_conn);
        echo htmlentities($e['message']);
        $success = False;
    }

    foreach ($list as $tuple) {
        foreach ($tuple as $bind => $val) {
            //echo $val;
            //echo "<br>".$bind."<br>";
            OCIBindByName($statement, $bind, $val);
            unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
    }

        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
            echo htmlentities($e['message']);
            echo "<br>";
            $success = False;
        }
    }
}

function connectToDB() {
    global $db_conn;

    // Your username is ora_(CWL_ID) and the password is a(student number). For example,
 // ora_platypus is the username and a12345678 is the password.
    $db_conn = OCILogon("ora_mading11", "a42013888", "dbhost.students.cs.ubc.ca:1522/stu");

    if ($db_conn) {
        debugAlertMessage("Database is Connected");
        // echo "success";
        return true;
    } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
        return false;
    }
}

function disconnectFromDB() {
    global $db_conn;

    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
}

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
        echo "<script type='text/javascript'> document.location = 'seller_main_page.html'; </script>";
    } else {
        $_SESSION['userName'] = $email;
        // TODO jump to customer_service
        echo "loginRequest success";
        echo "<script type='text/javascript'> document.location = 'seller_main_page.html'; </script>";
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

