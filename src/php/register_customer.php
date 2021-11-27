<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Customer Register Page </title>
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>
  <center>
    <h1>Register A Customer Account</h1>
  </center>
  <form method="POST" action="register_customer.php">
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
      <p>Already have an account? <a href="login_customer.php">Sign in</a>.</p>
    </div>
  </form>
  <?php

require ('dbUtilUBCServer.php');

function handeleRegisterRequest() {
    global $db_conn;

    if (isset($_POST['email']) == false || isset($_POST['psw']) == false
        || isset($_POST['psw-repeat']) == false || isset($_POST['name']) == false) {
        echo "You must fill put emial, name, and password";
        header("refresh:10");
    }

    if ($_POST['psw'] != $_POST['psw-repeat']) {
        echo "the second password is not matched, please try again.";
    } else {
        $tuple = array (
            ":bind1" => $_POST['email'],
            ":bind2" => $_POST['psw'],
            ":bind3" => $_POST['psw-repeat'],
            ":bind4" => $_POST['name'],
            ":bind5" => uniqid(),
            ":bind6" => $_POST['province'],
            ":bind7" => $_POST['city'],
            ":bind8" => $_POST['address'],
            ":bind9" => $_POST['postal_code'],
            ":streetname" => "",
            ":streetno" => ""
        );

        $alltuples = array (
            $tuple
        );

        $email = $_POST['email'];
        $postal = $_POST['postal_code'];

        $result1 = executePlainSQL("SELECT Count(*) FROM Account WHERE email_address = '$email'");
        $result2 = executePlainSQL("SELECT Count(*) FROM Customers_Have_1 WHERE postal_code = '$postal'");

        if (($row = oci_fetch_row($result1))[0] == 0) {
            executeBoundSQL("insert into Account values (:bind1, :bind2)", $alltuples);
            if (($row2 = oci_fetch_row($result2))[0] == 0) {
                executeBoundSQL("insert into Customers_Have_1 values (:bind9, :bind6, :bind7)", $alltuples);
            }
            executeBoundSQL("insert into Customers_Have_2 values (:bind5, :bind1, :bind4, :bind9, :streetname, :streetno, :bind8)", $alltuples);
            echo "registration success!";
        } else {
            echo "account already exist.";
        }
    }

    OCICommit($db_conn);
}
// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('registerRequest', $_POST)) {
            handeleRegisterRequest();
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

if (isset($_POST['registration'])) {
    handlePOSTRequest();
} else if (isset($_GET['showProductRequest'])) {
    handleGETRequest();
}
?>


</body>

</html>

