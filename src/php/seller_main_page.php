<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Customer Register Page </title>
  <link rel="stylesheet" href="../frontend/css/register.css">
</head>

<body>
  <center>
    <h1>Register A Customer Account</h1>
  </center>
  <form method="POST" action="register_seller.php">
    <div class="container">

      <input type="hidden" id="registerRequest" name="registerRequest">
      <section class="left">
        <label for="email">Email:</label>
      </section>
      <section>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>
      </section>

      <section class="left">
        <label for="psw">Password:</label>
      </section>
      <section>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      </section>

      <section class="left">
        <label for="psw-repeat">Repeat Password:</label>
      </section>
      <section>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
      </section>

      <section class="left">
        <label for="name">Name:</label>
      </section>
      <section>
        <input type="text" placeholder="Enter Your First Name" name="name" id="name">
      </section>

      <section class="left">
        <label for="province">Province:</label>
      </section>
      <section>
        <input type="text" placeholder="Example: British Columbia" name="province" id="province">
      </section>

      <section class="left">
        <label for="city">City:</label>
      </section>
      <section>
        <input type="text" placeholder="Example: Vancouver" name="city" id="city">
      </section>

      <section class="left">
        <label for="address">Street address, building, unit:</label>
      </section>
      <section>
        <input type="text" placeholder="Example: Room 101, Building A, 1000 Lower Mall" name="address" id="address">
      </section>

      <section class="left">
        <label for="_">Postal Code:</label>
      </section>
      <section>
        <input type="text" placeholder="Example:V6T 1X1" name="postal_code" id="postal_code" pattern="[A-Z][0-9][A-Z] [0-9][A-Z][0-9]">
      </section>


      <button type="submit" name="registration">

        Register
      </button>

    </div>
    <div class="container signin">
      <p>Already have an account? <a href="../frontend/html/login_customer.html">Sign in</a>.</p>
    </div>
  </form>

        <?php

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
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

        function printResult($result) { //prints results from a select statement
            echo "<br>Retrieved data from product table:<br>";
            echo "<table>";
            echo "<tr><th>Product ID</th><th>Sller ID</th><th>Producr Name</th><th>Parcel Dimension</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["PRODUCT_ID"] . "</td><td>" . $row["SELLER_ID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["PARCEL_DIMENSION"] ."</td></tr>";
            }

            echo "</table>";
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

        function handleAddProductRequest() {
            global $db_conn;

            if (isset($_POST['productName']) == false || isset($_POST['parcelDimension']) == false) {
                echo "You must fill all blanks!";
                header("refresh:10");
            }

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => uniqid(),
                ":bind2" => $_POST['sellerID'],
                ":bind3" => $_POST['productName'],
                ":bind4" => $_POST['parcelDimension'],
                ":bind5" => ""
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into products_post values (:bind1, :bind2, :bind3, :bind4, :bind5)", $alltuples);
            OCICommit($db_conn);
        }

        function handleDeleteProduct() {
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

        function handleShowProductRequest() {
            global $db_conn;
            $sellerID = $_GET['sellerID'];
            $result = executePlainSQL("SELECT * FROM products_post WHERE seller_ID = '$sellerID'");
            printResult($result);
        }

        // HANDLE ALL POST ROUTES
   // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
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
        function handleGETRequest() {
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
